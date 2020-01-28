<?php
	session_start();
	include "header2.php"; 

?>
<!DOCTYPE html>
<html>
<head>
<title>category list</title>
	<meta charset="utf-8">
	<meta content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<style type="text/css">
		
		nav a img{
			width: 50px;
			height: 50px;
		}
		.nav a{
			font-size: 16px;
			color: #ffff00 !important;
		}
		.nav a:hover{
			color: white !important;
		}
		.thumbnail{
			border: solid #ffff00;

		}
		footer{
			background-color: black;
			

			}
		footer img{
			width: 100px;
			height: 100px;
			align-self: center;

		}
		
		footer span{
			position: relative;
			right: 20px;
			color: white;
		}
		.btn-info a{
			text-decoration: none;
			color: white;
		}
		/*.btn-info{
			position: relative;
			left: 240px;
		}*/
	</style>
		
</head>
<body>
	
		<!-- <nav class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<a href="">
						<img src="C:\Users\ayush.DESKTOP-LNUBNI5\Pictures\bat1.jpg" class="img-responsive">
						<button type="button" class="btn navbar-toggle" data-toggle="dropdown" data-target="#mynavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</a>
				</div>
				<div class="navbar-collapse collapse" id="mynavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="assign2home.html">Home</a></li>
					<li><a href="assign2services.html">Service</a></li>
					<li><a href="about.html">About Batman</a></li>
					<li><a href="assign2whybat.html">Why Batman</a></li>
					<li><a href="#">Merchandise</a></li>
				</ul>
				</div>
			</div>
			
	 
		</nav>-->
	
	
	<div class="container">
		
			
		    <div class="row">
		    	<h1>Batmans Merchandise</h1>
			<div class="col-md-4">
				<div class="thumbnail">
					<img src="keychain.jpg">
					<div class="caption">
						<h3>Batman Key Chain</h3>
						<a href="productlist.html"><button type="button" class="btn btn-info col-lg-offset-8">
							See More
						</button></a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="thumbnail">
					<img src="tshirt.jpg">
					<div class="caption">
						<h3>Batman Tshirts</h3>
						
							
						    <a href="productlist2.html"><button type="button" class="btn btn-info col-lg-offset-8">
							See More
							</button></a>
							
						
					</div>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="thumbnail">
					<img src="mug.jpg">
					<div class="caption">
						<h3>Batman Mugs</h3>
						<a href="productlist3.html"><button type="button" class="btn btn-info col-lg-offset-8">
							See More
						</button></a>
					</div>
				</div>
			</div>
	</div>
	</div>

	<footer class="container-fluid">
		<div class="col-md-5"></div>
		<div class="col-md-2">
			
			<img src="bat1.jpg" class="img-responsive">
			
			<span>Copyright Batman Corp.</span>
			
			
		</div> 
		<div class="col-md-5"></div>

	</footer>
<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</body>
</html>