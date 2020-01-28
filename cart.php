<?php
	session_start();
	include "header2.php";
	include "helper.php";
	include "connect.php";
	if(!isset($_SESSION['_login']))
	{
		flash("danger","please login");
		header("location: login.php");
		die();
	}
	$cartid=$_SESSION['_login'];
	if(isset($_SESSION['cart'.$cartid]))
	{
		$cart=$_SESSION['cart'.$cartid];
	}	

try{
	$conn=connect();
	$sql="select products.*,category.name as category_name from products join category on products.c_id=category.id";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$products=$stmt->fetchAll();
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
	<style type="text/css">
		.nav ul li a{
			margin: 15px 15px;
		}
	</style>
</head>
<body>
	
	<div class="container">
		<h3 style="margin-bottom: 20px;">My Cart(<?php if(isset($_SESSION['cart'.$cartid])) echo count($cart);?>)
		<a href="<?php echo "removefromcart.php"."?emptycart=true";?>" class="btn btn-danger pull-right">Empty</a>
		</h3>

		<h4>Products</h4>

		<?php if(isset($_SESSION['cart'.$cartid])){?>
		<div class="row">
			<div class="col-md-8" style="box-shadow: 2px 2px grey; margin-bottom: 20px;">

			<?php foreach($cart as $c){?>

				<?php if(isset($c['productid'])){?>

				<div class="col-md-12" style="box-shadow: 2px 2px grey; margin-bottom: 10px;">
				<?php foreach($products as $p){?>
				<?php if($c['productid']==$p['id']){?>
				<div class="col-md-3">
					<div class="thumbnail">
						<img src="<?php echo $p['image'];?>">
					</div>
				</div>
				<div class="col-md-7">
					<h4><?php echo $p['name']?></h4>
					<p>
						Per Product Rs <?php echo $p['price'];?><br>
						Quantity <?php echo $c['quantity'];?><br>
						Category <?php echo $p['category_name'];?>
					</p>
					<div class="pull-right">
						<a class="btn btn-danger" href="<?php echo "removefromcart.php"."?remove=".$p['id'];?>"><i class="fa fa-trash" style="font-size: 20px;"></i></a>
					</div>
				</div>
				<div class="col-md-2">
					<div class="thumbnail alert alert-info">
						Rs <?php echo $p['price']*$c['quantity'];?>
						
					</div>
					<div class="caption">
							Rs <?php  echo $p['price']." x ".$c['quantity'];?>
					</div>
					
				</div>
				<?php }?>
				<?php }?>
			</div>
			<?php }?>
			<?php }?>
			</div>
			<div class="col-md-4" style="box-shadow: 2px 2px 2px 2px red; margin-bottom: 20px;">
				<h3 style="text-align: center;">Subtotal</h3>
				<?php $total=0;?>
				<?php foreach($cart as $c){?>
				<?php foreach($products as $p){?>
				<?php if($c['productid']==$p['id']){?>
				<div class="col-md-12" style="box-shadow: 2px 2px grey;">
					<?php echo $p['name']?>
					<span class="pull-right" style="color: black;">Rs <?php echo $p['price']*$c['quantity'];?></span>
					<?php $total+=$p['price']*$c['quantity'];?>
				</div>
				<hr>
				<?php }?>
				<?php }?>
				<?php }?>
				<div class="col-md-12" style="box-shadow: 2px 2px grey;">
					<?php echo "CGST"?>
					<span class="pull-right" style="color: black;">Rs <?php echo .09*$total;?></span>
					
				</div>
				<div class="col-md-12" style="box-shadow: 2px 2px grey;">
					<?php echo "SGST"?>
					<span class="pull-right" style="color: black;">Rs <?php echo .09*$total;?></span>
					
				</div>
				<?php $total=$total+$total*.09*2;?>
				<div class="col-md-12">
					<h3>TOTAL
					<span class="pull-right" style="color: black;"><?php echo $total;?></span></h3>
				</div>
				<div style="text-align: center; margin: 20px;">
					<?php if(isset($_SESSION['cart'.$cartid])){?>
						<?php if(count($_SESSION['cart'.$cartid])){?>
						<a href="billing.php" class="btn btn-success" style="color: white">Checkout <i class="fa fa-sign-out"></i></a>
					<?php }?>
					<?php }?>
				</div>
			</div>

		</div>
	<?php }?>
	</div>
	
</body>
</html>

<?php
include "footer.php";
?>

