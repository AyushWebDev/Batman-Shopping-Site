<?php
	session_start();
	include "header2.php";
	include "helper.php";
	include "connect.php"; 
	if(!isset($_SESSION['_login']))
	{
		flash("danger","Please Login To Access");
		header("location:login.php");
		die();
	}
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
		.pagebody{
	background-image: url(batmanbanner.jpg);
	}
	</style>
</head>
<body class="pagebody img-responsive">
	<div class="container" >
		<div class="col-md-6 formcontainer">
			<div class="formheading">
			<h3>
				<i class="fa fa-user" style="color: #ffff33;"></i> Shipping Address
			</h3>
			</div>

			<form action="storeaddress.php" method="POST">
				<div class="form-group col-md-6" >
				<input type="text" name="address1" placeholder="Address line 1" class="form-control" value="<?php if(isset($value['address1'])) echo $value['address1'];?>">
				<br><span><?php if(isset($error['address1'])) echo $error['address1']?></span>
				</div>

				<div class="form-group col-md-6">
				<input type="" name="address2" placeholder="Address line 2" class="form-control" value="<?php if(isset($value['address2'])) echo $value['address2'];?>">
				<br><span><?php if(isset($error['address2'])) echo $error['address2']?></span>

				</div>

				<div class="form-group col-md-12" >
				<select placeholder="City" class="form-control" name="city" value="<?php if(isset($value['city'])) echo $value['city'];?>">
					
					<option>Allahabad</option>
					<option>Lucknow</option>
					<option>Delhi</option>

				</select> 

				</div>

				<div class="form-group col-md-12" >
					<input type="number" name="pincode" placeholder="Pincode" class="form-control"  value="<?php if(isset($value['pincode'])) echo $value['pincode'];?>">
					<br><span><?php if(isset($error['pincode'])) echo $error['pincode']?></span>

				</div>

				<div class="form-group col-md-12" >
				<select placeholder="Home/Work/Other" class="form-control" name="name" value="<?php if(isset($value['name'])) echo $value['name'];?>">
					
					<option>Home</option>
					<option>Work</option>
					<option>Other</option>

				</select> 
				<br><span><?php if(isset($error['name'])) echo $error['name']?></span>

				</div>

				

				

				<!-- <div class="col-md-5"></div> -->
				
			
					<div class="button col-md-6">
					<button type="submit" class="btn" class="form-control">Save Address</button>
					</div>
					
					<div class="button col-md-6">
					<button href="cart.php" class="btn" class="form-control">Back To Cart</button>
					</div>
			
				
				
			</form>
		</div>
	</div>
	<?php include "footer.php";?>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>

</body>

</html>
<?php 
unset($_SESSION['error']);
unset($_SESSION['value']);


?>