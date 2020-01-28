<?php
	session_start();
	include "helper.php";
	include "connect.php";

	if(!isset($_SESSION['_login']))
	{
		flash("danger","please login");
		header("location: login.php");
		die();
	}
	$value=[];
	$error=[];
	try{
		$conn=connect();
		$sql="select * from products where id=:id";
		$cartid=$_SESSION['_login'];
		$stmt=$conn->prepare($sql);
		$stmt->bindParam(':id',$id);
		$id=$_GET['prod_id'];
		$stmt->execute();
		$product=$stmt->fetch();

		if($_SERVER['REQUEST_METHOD']=='GET')
		{
			$value['quantity']=1;
		}
		else if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$Q=trim($_POST['quantity']);
			if(empty($Q))
			{
				$error['quantity']="quantity can't be empty";
			}
			else
			{
				if($Q<=0)
				{
					$error['quantity']="quantity must be greater than zero";
				}
				else
					$value['quantity']=$Q;
			}
		}
		else
		{
			flash("danger","something went wrong");
			header("location:productdetail.php");
		}

		if(count($error)==0)
		{
			$productdetail=array('productid'=>$product['id'],'quantity'=>$value['quantity']);
			if(isset($_SESSION['cart'.$cartid]))
			{
				$cart=$_SESSION['cart'.$cartid];
				foreach($cart as $c)
				{
					if($c['productid']==$productdetail['productid'])
					{
						flash("info","OOPSS!! Product already exist in cart");
						header("location:productdetail.php"."?prod_id=".$c['productid']);
						die();
					}
				}

				$p=$productdetail['productid'];
				$cart[$p]=$productdetail;
			}
			else
			{
				$p=$productdetail['productid'];
				$cart[$p]=$productdetail;
			}

			$_SESSION['cart'.$cartid]=$cart;

			if($_SERVER['REQUEST_METHOD']=='GET') 
			{
				flash("success",$product['name']." has been added to your cart");
				header("location:"."productdetail.php"."?prod_id=".$product['id']);
			}
			else if($_SERVER['REQUEST_METHOD']=='POST')
			{
				flash("success",$product['name']." has been added to your cart");
				header("location:"."productdetail.php"."?prod_id=".$product['id']);
			}

			
		}
		else
		{
			$_SESSION['error']=$error;
			header("location:productdetail.php"."?prod_id=".$product['id']);
		}
	}
	catch(PDOException $e)
	{
		echo $e->getmessage();
	}
?>