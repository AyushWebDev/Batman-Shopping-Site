<?php
	$s="localhost";
	$u="root";
	$p="";
	$db="batmandata";

	try{
		$conn=new PDO("mysql:host=$s;dbname=$db",$u,$p);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql="alter table user add column verification_code bigint";
		$conn->exec($sql);
		echo "executed!!";
		
	}
	catch(PDOException $e)
	{
		echo $e->getmessage();
	}

?>
