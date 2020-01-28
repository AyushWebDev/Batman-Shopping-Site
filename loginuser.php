<?php
	session_start();
	require "connect.php";
	require "helper.php";
 
	$error=[];
	$value=[]; 
	$conn=connect();   

	$email=trim($_POST['email']);
	$password=trim($_POST['password']);
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(empty($email))
		{
			$error['email']="EMAIL CANNOT BE EMPTY";
		}
		else
		{
			if(!filter_vaR($email,FILTER_VALIDATE_EMAIL))
				$error['email']="INVALID EMAIL";
			else
			{
				$value['email']=$email;
			}
		}

		if(empty($password))
		{
			$error['password']="PASSWORD CANNOT BE EMPTY";
		}
		else
		{
			if(strlen($password)<6)
				$error['password']="PASSWORD MUST HAVE ATLEAST 6 LETTERS";
			else
			{
				$value['password']=md5($password);
			
			}
		}
	}
	else
	{
		flash("danger","something went wrong");
		header("location:login.php");
	}

	if(count($error)>0)
	{
		$_SESSION['error']=$error;
		$_SESSION['value']=$value;
		header("location:login.php");
	}
	else
	{
		try
		{
			$sql="select * from user where email=:email && password=:password";
			$stmt=$conn->prepare($sql);
			$stmt->execute($value);
			

			if($stmt->rowCount()>0)
			{
				

				$user=$stmt->fetch();
				
				$_SESSION['user']=$user;
					
				
				login($user['id']);
			
			}
			else
			{
				flash("danger","INVALID USERNAME AND PASSWORD");
				header("location:login.php");
			}
		}
		catch(PDOException $e)
		{
			echo "<br>".$e->getmessage();
		}
	}

	
?>