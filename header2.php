<?php
	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="stylepage.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		

.glyphicon{
		size: 30px;
	}
	</style>

</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
		<div class="navbar-header">
			<img src="bat1.jpg">

			<button type="button" class="btn navbar-toggle" data-toggle="collapse" data-target="#myid">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="myid">
			<ul class="nav navbar-nav">
				<li><a href="">Home</a></li>
				<li><a href="">About</a></li>
				<li><a href="">Services</a></li>
				<li><a href="merchandise.php">Merchandise</a></li>
				
				
				<?php if(isset($_SESSION['_login'])){?>
					<?php $cartid=$_SESSION['_login'];?>
					<?php if(isset($_SESSION['cart'.$cartid])){?>
					<li><a href="cart.php">My Cart(<?php echo count($_SESSION['cart'.$cartid])?>)</a></li>
				<?php }?>
				<li><a href="">My Orders</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><i class="fa fa-sign-out" style="color: #ffff33;"></i> LOG OUT</a></li>
				<li><a href=""><button class="btn" style="color: black; background-color: #ffff33;">
					<?php 
					if(isset($_SESSION['user']))
					{
						$user=$_SESSION['user'];
						echo $user['firstname']." ".$user['lastname'];
					}
					?>
					</button></a>
				</li>
				
				
			</ul>
			<?php } else{ ?>
			 <ul class="nav navbar-nav navbar-right"> 
				 <li ><a href="login.php"><i class="fa fa-sign-in" style="color: #ffff33;"></i> LOG IN</a></li>
			</ul>
		<?php }?>
			
		</div>

		</div>
		
	</nav>
	<?php
		if(isset($_SESSION['flash']))
			$flash=$_SESSION['flash'];
	?>
	<div class="alert alert-<?php if(isset($flash)) echo $flash['level'];?>" style="text-align: center;">
		<strong><?php if(isset($flash)) echo $flash['message'];?></strong>
	</div>
	 
		<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</body>
<?php unset($_SESSION['flash'])?>
</html>