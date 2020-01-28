<?php
	session_start();
	require "connect.php";
	require "helper.php";
 
	$error=[];
	$value=[]; 
	$conn=connect();   

	$password1=trim($_POST['password1']);
	$password2=trim($_POST['password2']);
	$code=$_SESSION['verification_code'];
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(empty($password1))
		{
			$error['password1']="PASSWORD CANNOT BE EMPTY";
		}
		else
		{
			if(strlen($password1)<6)
				$error['email']="PASSWORD MUST HAVE ATLEAST 6 LETTERS";
			else
			{
				$value['password1']=md5($password1);
			}
		}

		if(empty($password2))
		{
			$error['password2']="PASSWORD CANNOT BE EMPTY";
		}
		else
		{
			if(strlen($password2)<6)
				$error['password2']="PASSWORD MUST HAVE ATLEAST 6 LETTERS";
			
			else
			{
				$value['password2']=md5($password2);
				if($password2!=$password1)
				{
					$error['password2']="PASSWORDS SHOULD BE SAME";
				}
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
		
		header("location:login.php");
	}
	else
	{
		try
		{
			$sql="update user set password='{$value['password1']}',verification_code=null where verification_code='$code'";
			$stmt=$conn->prepare($sql);
			$result=$stmt->execute();
			

			if($result)
			{
				unset($_SESSION['verification_code']);
				flash("success","your password has been changed");
				header("location: homepage.php");
			}
			else
			{
				flash("danger","something went wrong");
				header("location:changepass.php");
			}
		}
		catch(PDOException $e)
		{
			echo "<br>".$e->getmessage();
		}
	}

	
?>