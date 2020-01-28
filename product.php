<?php
	session_start();
	include "helper.php";
	if(!isset($_SESSION['_login']))
	{
		flash("danger","please login");
		header("location:login.php");
		die();
	}
?>
<?php
	include "header2.php";
	include "connect.php";

	try{
		$conn=connect();
				$sql="select * from category;";
				$stmt=$conn->prepare($sql);
				$stmt->execute();
				$category=$stmt->fetchAll();
		
		$sql="select products.*,category.name as category_name from products join category ON products.c_id=category.id where c_id=:id";
		$stmt=$conn->prepare($sql);
		$stmt->bindParam(':id',$c_id);
		$c_id=$_GET['category'];
		$stmt->execute();
		$product=$stmt->fetchAll();
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
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading"><a data-toggle="collapse" href="#mycollapse">Browse</a></div>
					<div class="panel-content panel-collapse collapse" id="mycollapse">
						<ul>
							<?php foreach($category as $c){ ?>
							<li><a href="<?php echo "product.php"."?category=".$c['id'];?>"> <?php echo $c['name'];?></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
				<?php foreach($product as $p){ ?>
					<div class="col-md-3">
						<div class="thumbnail">
							<img src="<?php echo $p['image'];?>" class="img-responsive">
							<div class="caption">
								<h3><?php echo $p['name'];?></h3>
								<p>Category: <?php echo $p['category_name'];?></p>
								<div class="col-md-12 text-right">
									<strong><h5>Rs <?php echo $p['price'];?></h6></strong>
								</div>
								<span class="text-right"><a href="<?php echo "addtocart.php"."?prod_id=".$p['id']?>" class="btn btn-success" style="margin-right: 5px">Add To Cart</a>
								<a href="<?php echo "productdetail.php"."?prod_id=".$p['id']?>" class="btn btn-info" style="margin-left: 5px">View Product</a>
								</span>
							</div>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>

	<?php include "footer.php";?>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</body>
</html>