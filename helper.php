<?php
	
	function flash($level,$message)
	{
		$flash['level']=$level;
		$flash['message']=$message;
		$_SESSION['flash']=$flash; 
	}  

	function login($id) 
	{
		if(isset($_SESSION['_login']))
		{
			flash("danger","you are already logged in");
			header("location:homepage.php");
		}
		else
		{
			$_SESSION['_login']=$id;
			$user=$_SESSION['user'];
			flash("success","Welcome {$user['firstname']}!! You Are Succesfully Logged In");
			
			    	header("location:homepage.php");
		}

	}

	function logout()
	{
		if(isset($_SESSION['_login']))
			unset($_SESSION['_login']);
		
			header("localhost:login.php");
				
	}
?>