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
</head>
<body class="regbody">
	<div class="container" >
		<div class="col-md-6 formcontainer">
			<div class="formheading">
			<h3>
				<i class="fa fa-user" style="color: #ffff33;"></i> Register
			</h3>
			</div>

			<form action="registeruser.php" method="POST">
				<div class="form-group col-md-6" >
				<input type="text" name="firstname" placeholder="Firstname" class="form-control" value="<?php if(isset($value['firstname'])) echo $value['firstname'];?>">
				<br><span><?php if(isset($error['firstname'])) echo $error['firstname']?></span>
				</div>

				<div class="form-group col-md-6">
				<input type="" name="lastname" placeholder="Lastname" class="form-control" value="<?php if(isset($value['lastname'])) echo $value['lastname'];?>">
				<br><span><?php if(isset($error['lastname'])) echo $error['lastname']?></span>

				</div>

				<div class="form-group col-md-6" >
				<input type="" name="email" placeholder="Email" class="form-control" value="<?php if(isset($value['email'])) echo $value['email'];?>">
				<br><span><?php if(isset($error['email'])) echo $error['email']?></span>

				</div>

				<div class="form-group col-md-6" >
				<input type="" name="contact" placeholder="Contact" class="form-control" value="<?php if(isset($value['contact'])) echo $value['contact'];?>">
				<br><span><?php if(isset($error['contact'])) echo $error['contact']?></span>

				</div>

				<div class="form-group col-md-6" >
				<select placeholder="City" class="form-control" name="city" value="<?php if(isset($value['city'])) echo $value['city'];?>">
					
					<option>Allahabad</option>
					<option>Lucknow</option>
					<option>Delhi</option>

				</select> 
				<br><span><?php if(isset($error['city'])) echo $error['city']?></span>

				</div>

				<div class="form-group col-md-6" >
				<select placeholder="Gender" class="form-control" name="gender" value="<?php if(isset($value['gender'])) echo $value['gender'];?>">
					
					<option>Male</option>
					<option>Female</option>

				</select>
				<br><span><?php if(isset($error['gender'])) echo $error['gender']?></span>

				</div>

				<div class="form-group col-md-12">
					<input type="password" name="password" placeholder="password" class="form-control">
					<br><span><?php if(isset($error['password'])) echo $error['password']?></span>
				</div>

				<div class="form-group col-md-6 belowlink">
				</div>
				<div class="form-group col-md-6 belowlink text-right">
					<a href="login.php"><strong>Login</strong></a>
				</div>

				<!-- <div class="col-md-5"></div> -->
				<div class="button">
				<button type="submit" class="btn" class="form-control">Register</button>
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