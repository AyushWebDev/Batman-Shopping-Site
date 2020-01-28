<?php
	session_start();
	include "connect.php";
	include "helper.php";

	$code=$_GET['verification_code'];
	try{
		$conn=connect();
		$sql="select * from user where verification_code=:code";
		$stmt=$conn->prepare($sql);
		$stmt->bindParam(':code',$code);
		$stmt->execute();

		if($stmt->rowCount()>0)
		{
			$_SESSION['verification_code']=$code;
			header("location:changepass.php");
		}
		else
		{
			flash("danger","verification code is invalid");
			header("location:forgotpass.php");
		}
	}
	catch(PDOException $e)
	{
		echo $e->getmessage();
	}
?>