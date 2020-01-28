<?php
	session_start();
	include "helper.php";
	include "connect.php";
	$cartid=$_SESSION['_login'];
	try{
		if(isset($_GET['emptycart']))
		{
			if(isset($_SESSION['cart'.$cartid]))
			{
				unset($_SESSION['cart'.$cartid]);
				flash("success","Your cart is empty");
				header("location:cart.php");
			}
			else
			{
				flash("danger","Your cart is already empty");
				header("location:cart.php");
			}
		}

		if(isset($_GET['remove']))
		{
			$cart=$_SESSION['cart'.$cartid];
			foreach($cart as $k=>$c)
			{
				if($c['productid']==$_GET['remove'])
				{
				unset($cart[$k]);
				
				}
			}
			$_SESSION['cart'.$cartid]=$cart;
			flash("success","removed");
				header("location:cart.php");
			if(count($cart)==0)
			{
			unset($_SESSION['cart'.$cartid]);
			header("location:cart.php");
			}
		}


	}
	catch(PDOException $e)
	{
		echo $e->getmessage();
	}
?>