<?php
	require "connect.php";
	$conn=connect();
try{
	$sql="create database batmanData";
	$conn->exec($sql);
	echo "<br>DB created";
}

catch(PDOException $e)
{
	echo "query failed".$e->getmessage();
}
?>