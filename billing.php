<?php
session_start();
	include "header2.php";
	include "connect.php";
	include "helper.php";

	if(!isset($_SESSION['_login']))
	{
		flash("danger","please login to access");
		header('login.php');
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

	$conn=connect();
	$u=$_SESSION['_login'];
	$sql="select * from useraddress where userid='$u'";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$add=$stmt->fetchAll();
	if(count($add)==0)
	{
		flash("info","Please Add Your Address");
		header("location:shippingaddress.php");
	}
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
		.formcontainer h4{
			color: white;
		}
		
		.radio div{
			color: white;
		}

	</style>
</head>
<body class="regbody img-responsive">
	<div class="container" >
		<div class="col-md-6 formcontainer">
			<div class="formheading">
			<h3>
				Billing Options
			</h3>
			</div>
			<h4>Delivery Address:</h4>
			<form action="placeorder.php" method="POST" class="form-group">
				
				<?php foreach($add as $a){?>
				
				<div class="radio" style="margin: 20px 20px;">
					<div class="radio"><input type="radio" name="address" value="<?php echo $a['id'];?>"><strong><?php echo $a['name']?>:</strong></div>
					<div class="" style="border: 1px solid white;">
						<?php echo $a['address1']?><br>
						<?php echo $a['address2']?><br>
						<?php echo $a['city']?> - <?php echo $a['pincode']?>
					</div>
				</div>
				<?php }?>
				<div class="col-md-12">
				<button class="btn pull-right" href="shippingaddress.php">Add New Address</button>
				</div>
				
				
				<div class="col-md-12 row" style="margin: 20px 20px;">
					<div class="col-md-6">
						<button class="btn" href="cart.php" style="margin: 10px 10px;">Back To Cart</button>
					</div>
					<div class="col-md-6">
						<button type="submit" class="btn" style="margin: 10px 10px;">Place Order</button>
					</div>
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