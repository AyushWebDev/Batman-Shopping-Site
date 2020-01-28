<?php
	require "connect.php";
	$conn=connect();

	try{
		$sql="create table user(firstname varchar(30),lastname varchar(30),email varchar(30),contact bigint,city varchar(30),gender varchar(10),password varchar(10))";

		$stmt=$conn->prepare($sql);
		$stmt->execute();
		echo "<br>table created";
	}
	catch(PDOException $e)
	{
		echo "query failed".$e->getmessage();
	}
?>