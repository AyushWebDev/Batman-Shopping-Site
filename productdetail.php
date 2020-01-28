<?php
	session_start();
	include "helper.php";
	include "connect.php";
	include "header2.php";

	if(!isset($_SESSION['_login']))
	{
		flash("danger","please login");
		header("location: login.php");
		die();
	}
	$error=[];
	if(isset($_SESSION['error']))
	{
		$error=$_SESSION['error'];
	}
	
	try{
	$conn=connect();
	$sql="select products.*,category.name as category_name from products join category on products.c_id=category.id where products.id=:id";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':id',$id);
	$id=$_GET['prod_id'];	
	$stmt->execute();
	$product=$stmt->fetch();
	}
	catch(PDOException $e)
	{
		echo $e->getmessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="stylepage.css">
</head>
<body>
	<div class="container">
		<h3 class="alert alert-info">Batman Merchandise</h3>
		<div class="col-md-4">
			<div class="thumbnail">
			<img src="<?php echo $product['image'];?>">
			</div>
		</div>
		<div class="col-md-6">
			<h2><?php echo $product['name'];?></h4>
			<p>
				Free Shipping<br>
				Category: <?php echo $product['category_name'];?><br>
				<b>Description:</b><br>
				<?php echo $product['description'];?><br>
				<hr>
			</p>
			<form action="<?php echo "addtocart.php"."?prod_id=".$product['id']?>" class="form-inline" method="POST">
				
				<div class="form-group">
					<label>Quantity:</label>
					<input type="number" name="quantity">
					<span style="color: black;"><?php if(isset($error['quantity'])) echo $error['quantity'];?></span>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Add To Cart</button>
				</div>
			</form>
		</div>
		<div class="col-md-2">
			<h4>Rs: <?php echo $product['price'];?></h4>
		</div>
	</div>

	<?php include "footer.php";?>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</body>
<?php unset($_SESSION['error']);?>
</html>