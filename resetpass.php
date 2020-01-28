<?php
	session_start();
	include "connect.php";

	$error=[];
	$value=[];
	$conn=connect();

	$email=trim($_POST['email']);

	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(empty($email))
		{
			$error['email']="EMAIL CANNOT BE EMPTY";
		}

		else
		{
			if(!filter_var($email,FILTER_VALIDATE_EMAIL))
				$error['email']="INVALID INPUT";
			else
			{
				try{
				$sql="select * from user where email=:email";
				$stmt=$conn->prepare($sql);
				$stmt->execute(array(':email'=>$email));

				if($stmt->rowCount()>0)
				{
					$user=$stmt->fetch();
				}
				else
				{
					$error['email']="EMAIL DOESN'T EXIST";
				}
			}
				catch(PDOException $e)
				{
					echo $e->getmessage();
				}
			}
		}
	}

	else
	{
		flash("danger","something went wrong");
		header("location:forgotpass.php");
	}

	if(count($error)==0 && $user)
	{
		$sql="select * from user where verification_code=:code";
		$stmt=$conn->prepare($sql);
		while(!isset($uniquecode))
		{
			$code=rand(100,9999);
			$code=md5($code);
			
			$stmt->bindParam(':code',$code);
			$stmt->execute();
			if($stmt->rowCount()==0)
			{
				$uniquecode=$code;
			}
		}

		$sql="update user set verification_code='$code' where id={$user['id']}";
		$stmt=$conn->prepare($sql);
		$stmt->execute();

		$to_email=$user['email'];
		$subject="Forgot Password||Batman Site";
		$header="From: noreply@comp.com";
		$link="verifycode.php"."?verification_code=$code";
		$message="This mail is for changing password<br>please click on below link<br><a href={$link}>reset password</a>";
		echo $message;
		$result=mail($to_email,$subject,$message);
		die();

		if($result)
		{
			flash("success","we have sent a mail!! Please check your mail");
			header("location:homepage.php");
		}
		else
		{
			flash("danger","something went wrong");
			header("location:login.php");
		}
	}
	else
	{
		$_SESSION['error']=$error;
		$_SESSION['value']=$value;
	}
?>