<?php
session_start();
require "connect.php";
require "helper.php";
$error=[];
$value=[];
$conn=connect();    

$firstname=trim($_POST['firstname']);
$lastname=trim($_POST['lastname']);
$email=trim($_POST['email']);
$contact=trim($_POST['contact']);
$city=trim($_POST['city']);
$gender=trim($_POST['gender']); 
$password=trim($_POST['password']);

if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(empty($firstname))
	{
		$error['firstname']="PLEASE ENTER YOUR FIRSTNAME";
	}
	else
	{
		if(!preg_match("/^[a-z A-Z]+$/",$firstname))
			$error['firstname']="INCORRECT FIRSTNAME";
		else
			$value['firstname']=$firstname;
	}

	if(empty($lastname))
	{
		$error['lastname']="PLEASE ENTER YOUR LASTNAME";
	}
	else
	{
		if(!preg_match("/^[a-z A-Z]+$/",$lastname))
			$error['lastname']="INCORRECT LASTNAME";
		else
			$value['lastname']=$lastname;
	}

	if(empty($email))
	{
		$error['email']="PLEASE ENTER YOUR EMAIL";
	}
	else
	{
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			$error['email']="INCORRECT EMAIL";
		else
		{
			try
			{
				$sql="select * from user where email=:email";
				$stmt=$conn->prepare($sql);
				$stmt->bindParam(':email',$email);
				
				$stmt->execute();
				if($stmt->rowCount()>0)
					$error['email']="EMAIL ALREADY EXISTS";
				else
					$value['email']=$email;
			}
			catch(PDOException $e)
			{
				echo "<br>".$e->getmessage();
				die();
			}
		}
	}

	if(empty($contact))
	{
		$error['contact']="PLEASE ENTER YOUR CONTACT";
	}
	else
	{
		if(!preg_match("/^[6789][0-9]{9}$/",$contact))
			$error['contact']="INCORRECT CONTACT";
		else
		{
			try{
				$sql="select * from user where contact=:contact";
				$stmt=$conn->prepare($sql);
				$stmt->bindParam(':contact',$contact);
				$stmt->execute();

				if($stmt->rowCount()>0)
					$error['contact']="CONTACT ALREADY EXISTS";
				else
					$value['contact']=$contact;
			}
			catch(PDOException $e)
			{
				echo "<br>".$e->getmessage();
				die();
			}
		}
	}

	if(empty($city))
	{
		$error['city']="PLEASE ENTER YOUR CITY";
	}
	else
	{
		$value['city']=$city;
	}

	if(empty($gender))
	{
		$error['gender']="PLEASE ENTER YOUR GENDER";
	}
	else
	{
		$value['gender']=$gender;
	}
	
	if(empty($password))
	{
		$error['password']="PLEASE ENTER YOUR PASSWORD";
	}
	else
	{
		if(strlen($password)<6)
			$error['password']="PASSWORD MUST CONTAIN AT LEAST 6 CHARACTERS";
		else
			$value['password']=md5($password);
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
	header("location:register.php");
}
else
{
	try{
		$sql="insert into user (firstname,lastname,email,contact,city,gender,password) values(:firstname,:lastname,:email,:contact,:city,:gender,:password)";
		$stmt=$conn->prepare($sql);
		$stmt->execute($value);

			$sql="select * from user where email=:email && password=:password";
			$stmt=$conn->prepare($sql);
			$stmt->execute(array(':email'=>$value['email'],':password'=>$value['password']));
		if($stmt->rowCount()>0)
		{
		$user=$stmt->fetch();
		$_SESSION['user']=$user;
		login($user['id']);
		}
		else {
		 	flash("danger","something went wrong");
		 } 
	}
	catch(PDOException $e)
	{
		echo $e->getmessage();
	}
}

?>