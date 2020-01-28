<?php
	session_start();
	include "header2.php";
	include "helper.php";
	include "connect.php";

	try{
		$conn=connect();
		$sql="select purchasedetail.*, products.name from purchasedetail join products on purchasedetail.productid=products.id where purchasedetail.purchaseid=:pid";
		$stmt=$conn->prepare($sql);
		$pid=$_GET['order'];
		$stmt->bindParam(':pid',$pid);
		$stmt->execute();
		$products=$stmt->fetchAll();

		$sql="select * from purchase where id='$pid'";
		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$order=$stmt->fetchAll();
	}
	catch(PDOException $e)
	{
		echo $e->getmessage();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<style type="text/css">
		table tr td{
			border: 1px solid;
			padding: 20px;
		}
	</style>
</head>
<body>
	<div style="text-align: center;">
	<h1>
		Congratulation!! Thankyou For Shopping
	</h1>
	</div>
	<div class="row">
	<div class="col-md-4"></div>
	<div style="text-align: center;" class="col-md-4">
	<table >
		<tr>
			<td  colspan="4">
				<strong>Product Detail</strong>
			</td>
		</tr>
		<tr>
			<td><strong>Product Name</strong></td>
			<td><strong>Product Quantity</strong></td>
			<td><strong>Product Price</strong></td>
			<td><strong>Product Cost</strong></td>

		</tr>
		<?php foreach($products as $p){?>
		<tr>
			<td><?php echo $p['name']?></td>
			<td><?php echo $p['quantity']?></td>
			<td>Rs <?php echo $p['price']?> /-</td>
			<td>Rs <?php echo $p['cost']?> /-</td>
		</tr>
		<?php }?>
		<?php foreach($order as $o){?>
		<tr>
			<td rowspan="3"><strong>Total</strong></td>
			<td  colspan="2"><strong>Sum</strong></td>
			<td>Rs <?php echo $o['total']?> /-</td>
		</tr>
		<tr>
			<td colspan="2"><strong>Taxes(cgst+sgst)</strong></td>
			<td>Rs <?php echo $o['cgst']+$o['sgst']?> /-</td>
		</tr>
		<tr>
			<td colspan="2"><strong>Grand-Total</strong></td>
			<td><strong>Rs <?php echo $o['cgst']+$o['sgst']+$o['total']?> /-</strong></td>
		</tr>
		<?php }?>
	</table>
	</div>
</div>
	<div style="text-align: center;">
	<h1>
		Thank You!!
	</h1>
	</div>
</body>
</html>