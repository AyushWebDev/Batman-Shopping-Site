<?php
	session_start();
	include "connect.php";
	include "helper.php";
	if(!isset($_SESSION['_login']))
	{
		flash("danger","please login to access");
		header("location:login.php");
		die();
	}

	try{
		$conn=connect();

		$userid=$_SESSION['_login'];

		$sql="select * from user where id='$userid'";
		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$user=$stmt->fetch();

		if(isset($_POST["address"]))
				$shippingid=$_POST["address"];
		else {
			flash("danger","please select an address");
			header("location:billing.php");
			die();
		}

	
		
		$sql="select * from useraddress where id='$shippingid'";
		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$shippingaddress=$stmt->fetch();

		$sql="select products.*,category.name as category_name from products join category on products.c_id=category.id";
		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$products=$stmt->fetchAll();

		if(isset($_SESSION['cart'.$userid]))
			$cart=$_SESSION['cart'.$userid];
		$total=0;
		$i=0;
		foreach($cart as $c)
		{
			foreach($products as $p)
			{

				if($c['productid']==$p['id'])
				{
					$total+=$p['price']*$c['quantity'];
					$purchasedetail[$i]=array(
						"purchaseid"=>0,
						"productid"=>$p['id'],
						"price"=>$p['price'],
						"quantity"=>$c['quantity'],
						"cost"=>$p['price']*$c['quantity']
					);
					$i++;
				}
			}
		}

		$purchase=array(

			"userid"=>$userid,
			"shippingid"=>$shippingid,
			"cgst"=>.09*$total,
			"sgst"=>.09*$total,
			'total'=>$total
		);

		$sql="insert into purchase(userid,shippingid,cgst,sgst,total) values(:userid,:shippingid,:cgst,:sgst,:total)";
		$stmt=$conn->prepare($sql);
		$stmt->execute($purchase);



		$purchaseid=$conn->lastInsertId();
	
		


		$sql="insert into purchasedetail(purchaseid,productid,price,quantity,cost) values(:purchaseid,:productid,:price,:quantity,:cost)";
		$stmt=$conn->prepare($sql);
		foreach($purchasedetail as $p)
		{
			$p['purchaseid']=$purchaseid;
			$stmt->execute($p);
		}
		


		unset($_SESSION['cart'.$userid]);
		flash("success","your order has been placed!!");
		header("location:myorders.php");

	}
	catch(PDOException $e)
	{
		echo $e->getmessage();
	}
?>