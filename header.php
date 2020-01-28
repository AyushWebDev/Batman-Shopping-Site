
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="stylepage.css">
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
			<ul class="nav navbar-nav navbar-right">
				<li><a href="">Home</a></li>
				<li><a href="">About</a></li>
				<li><a href="">Services</a></li>
				<li><a href="">Merchandise</a></li>
				<li><a href="login.php">LOG IN</a></li>

			</ul>
			
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