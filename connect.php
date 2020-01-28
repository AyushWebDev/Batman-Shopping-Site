<?php
	$s="localhost";
	$u="root";
	$p="";
	$db="batmandata";  
function connect()
{
	global $s,$u,$p,$db;
	try{
		$conn=new PDO("mysql:host=$s;dbname=$db",$u,$p);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		return $conn;
	}
	catch(PDOException $e)
	{
		echo $e->getmessage();
	}
}
?>