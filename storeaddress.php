<?php
session_start();
require "connect.php";
require "helper.php";
$error=[];
$value=[];
$conn=connect();    

$address1=trim($_POST['address1']);
$address2=trim($_POST['address2']);
$city=trim($_POST['city']);
$pincode=trim($_POST['pincode']); 
$name=trim($_POST['name']);

$userid=$_SESSION['_login'];
$value['userid']=$userid;

if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(empty($address1))
	{
		$error['address1']="PLEASE ENTER YOUR ADDRESS1";
	}
	else
	{
		
			$value['address1']=$address1;
	}

	if(empty($address2))
	{
		$error['address2']="PLEASE ENTER YOUR ADDRESS2";
	}
	else
	{
		
			$value['address2']=$address2;
	}

	

	

	if(empty($city))
	{
		$error['city']="PLEASE ENTER YOUR CITY";
	}
	else
	{
		$value['city']=$city;
	}

	if(empty($pincode))
	{
		$error['pincode']="PLEASE ENTER YOUR PINCODE";
	}
	else
	{
		$value['pincode']=$pincode;
	}

	if(empty($name))
	{
		$error['name']="PLEASE ENTER YOUR NAME";
	}
	else
	{
		
		$value['name']=$name;
	}
}
else
{
	flash('danger','something went wrong');
	header('location:register.php');
}

if(count($error)>0)
{
	$_SESSION['error']=$error;
	$_SESSION['value']=$value;
	header("location:shippingaddress.php");
}
else
{
	try{
		$sql="insert into useraddress(userid,address1,address2,city,pincode,name) values(:userid,:address1,:address2,:city,:pincode,:name)";
		$stmt=$conn->prepare($sql);
		$stmt->execute($value);
		flash("success","ADDRESS Saved!!");
		header("location:billing.php");
			
		
	}
	catch(PDOException $e)
	{
		echo $e->getmessage();
	}
}

?>