<?php
session_start();
	include "header2.php";
?>
<?php 
	$error=[];
	$value=[]; 
 
	if(isset($_SESSION['error'])) 
	$error=$_SESSION['error'];
	
	if(isset($_SESSION['value']))
	$value=$_SESSION['value'];
?> 

<!DOCTYPE html>  
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="stylepage.css">
	<style type="text/css">
		.footer{
			margin-top: 150px;
			padding: 6px;
		}

	</style>
</head>
<body class="regbody img-responsive">
	<div class="container" >
		<div class="col-md-6 formcontainer">
			<div class="formheading">
			<h3>
				Change Password
			</h3>
			</div>
			<form action="changepassuser.php" method="POST">
				

				
				<div class="form-group col-md-12">
				<input type="password" name="password1" placeholder="New Password" class="form-control">
				<span><?php if(isset($error['password1'])) echo $error['password1']?></span>
				</div>
				
				<div class="form-group col-md-12">
					<input type="password" name="password2" placeholder="Retype Password" class="form-control">
					<span><?php if(isset($error['password2'])) echo $error['password2']?></span>

				</div>

				<!-- <div class="col-md-5"></div> --><br>
				<!-- <div class="form-group col-md-6 belowlink">
					<a href="">Forgot Password</a>
				</div>
				<div class="form-group col-md-6 belowlink text-right">
					<a href="register.php">Register</a>
				</div> -->
				<div class="button">
				<button type="submit" class="btn" class="form-control">Change Password</button>
				</div>
				
				
			</form>
		</div>
	</div>

	<?php include "footer.php";?>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>

</body>
<?php 

unset($_SESSION['error']);
unset($_SESSION['value']);

?>
</html>