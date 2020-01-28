<?php
	session_start();
	include "header2.php";
	include "connect.php";
	if(!isset($_SESSION['_login']))
	{
		flash("danger","please login");
		header("location: login.php");
		die();
	}

	try{
		$conn=connect();
		$userid=$_SESSION['_login'];
		$sql="select purchase.*,useraddress.address1,useraddress.address2,useraddress.city,useraddress.pincode,useraddress.name from purchase join useraddress on purchase.shippingid=useraddress.id where purchase.userid='$userid'";
		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$orders=$stmt->fetchAll();
		

		
		$sql="select purchasedetail.*,products.name from purchasedetail join products on purchasedetail.productid=products.id where purchaseid=:purchaseid";
		$stmt=$conn->prepare($sql);


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
		table td{
			border: 1px solid; padding: 10px;
		}
		span{
			color: black;
		}
	</style>
</head>
<body>
	
	<h2><span class="label label-default" style="background-color: black; color: white;">My Orders(<?php echo count($orders);?>)</span></h2>
	<hr>
	<?php foreach($orders as $o){?>
		<?php $pid=$o['id'];
		$stmt->bindParam(':purchaseid',$pid);
		$stmt->execute();
		$products=$stmt->fetchAll();
		?>
		<div style="padding: 20px;">
	<div class="col-md-8" style="box-shadow: 2px 2px 2px grey; margin-bottom: 50px; background-color: black; color: #ffff33;">
		<h3>
			Order
			<a href="<?php echo "invoice.php?order=".$pid?>" class="btn btn-info pull-right">Check Invoice</a>
		</h3>
		<div class="row">
			<div class="col-md-4">
			<h4><strong>Shipping Address</strong></h4>
			<p style="font-size: 15px;">
				<?php echo $o['address1']?>,<br>
				<?php echo $o['address2']?>,<br>
				<?php echo $o['city']?>-<?php echo $o['pincode']?>
			</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table style="font-size: 20px; border: 1px solid; padding: 10px;">
					<tr>
						<td><strong>product name</strong></td>
						<td><strong>product price</strong></td>
						<td><strong>product quantity</strong></td>
						<td><strong>product cost(price x quantity)</strong></td>
					</tr>
					<?php foreach($products as $p){?>
						<tr >
							<td><?php echo $p['name']?></td>
							<td><?php echo $p['price']?></td>
							<td><?php echo $p['quantity']?></td>
							<td><?php echo $p['cost']?></td>
						</tr>
					<?php }?>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-4" style="box-shadow: 2px 2px 2px 4px #8c8c8c; margin-bottom: 50px; font-size: 20px; background-color: #f2f2f2;">
		<h4 style="text-align: center;"><strong>Order Summary</strong></h4>
		<div class="col-md-12">Total<span class="pull-right"><?php echo $o['total'];?></span></div><hr>
		<div class="col-md-12">CGST<span class="pull-right"><?php echo $o['cgst'];?></span></div><hr>
		<div class="col-md-12">SGST<span class="pull-right"><?php echo $o['sgst'];?></span></div><hr>
		<h2 style="margin-top: 50px;"><div class="col-md-12">TOTAL<span class="pull-right">Rs <?php echo $o['total']+$o['cgst']+$o['sgst'];?>/-</span></div></h2>
	</div>

	</div>
	<?php }?>
</body>
</html>