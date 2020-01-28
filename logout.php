<?php
session_start();
	require "helper.php";
	logout();
	flash("success","logged out successfuly");
	header("location:homepage.php");
	
?> 