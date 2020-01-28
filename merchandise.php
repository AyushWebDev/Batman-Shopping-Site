<?php

	session_start();
	include "helper.php"
?>
	<?php if(!isset($_SESSION['_login']))
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
		<style type="text/css">
			.thumbnail{
				box-shadow: 5px 5px;
				border: solid #ffff00!important;
			}
			.nav a{
				font-size: 16px;
				margin: 20px 20px;
			}
		</style>
	</head>
	<body>
		<div class="container">
		<h2 class="alert alert-info">Batman Merchandise</h2>
		<div class="row">
		
		<?php foreach($category as $c)
			{
		?>
			<div class="col-md-4">
				<div class="thumbnail">
					<img src="<?php echo $c['image']?>" class="img-responsive">
					<div class="caption">
						<h3><?php echo $c['name']?></h3>
						<a href="<?php echo "product.php"."?category=".$c['id']?>" class="text-right"><button type="button" class="btn btn-info">See More</button></a>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
		

		</div>
		
		<?php include "footer.php";?>
		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap.min.js"></script>
	</body>
	</html>

