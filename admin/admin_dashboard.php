<?php
require_once("../database.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css?v=1.0">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
	<div id="wrapper">
		<div class="overlay"></div>

		<!-- Sidebar -->
		<nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
			<ul class="nav sidebar-nav">
				<div class="sidebar-header">
					<div class="sidebar-brand">
						<a href="#">Filfood-Admin</a>
					</div>
				</div>
				<li class="nav-item">
					<a class="nav-link" href="admin_dashboard.php">Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="foodAdmin.php">Food Admin</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="viewAllMenu.php">View Menu</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="customertable.php">Customer</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="viewAllOrders.php">Orders</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="admin_payment.php">Payments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="admin.php">Admin</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php">Log Out</a>
				</li>
			</ul>
		</nav>
		<div id="page-content-wrapper">
			<button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
				<span class="hamb-top"></span>
				<span class="hamb-middle"></span>
				<span class="hamb-bottom"></span>
			</button>
			<!--Start Editing here-->
			<div class="container">
				<div class="text-center text-white">
					<h1 class="fw-bolder">WELCOME TO ADMIN DASHBOARD</h1>
				</div>
			</div>
			<div class="container-fluid my-5">
				<div class="row offset-1 offset-sm-1 offset-md-2 offset-lg-2">
					<div class="card col-5 col-sm-5 col-md-5 col-lg-3 mx-1 my-2 py-3 text-light text-center bg-danger">
						<?php
                        $sql = "SELECT * FROM food";
                        $query = mysqli_query($connection, $sql);
                        $count = mysqli_num_rows($query);
                        ?>
						<h1 class="pt-3"><?php echo $count?></h1>
						<div class="pt-2 text-center">
							<h5>Total Food</h5>
						</div>

					</div>
					<div class="card col-5 col-sm-5 col-md-5 col-lg-3 mx-1 my-2 py-3 text-light text-center bg-warning ">
						<?php 
                        $sql0 = "SELECT order_date FROM customer";
                        $query0 = mysqli_query($connection, $sql0);
                        $count0 = mysqli_num_rows($query0);
                        ?>
						<h1 class="pt-3"><?php echo $count0?></h1>
						<div class="pt-2 card-title text-center">
							<h5>Total Customer</h5>
						</div>
					</div>
					<div class="card col-5 col-sm-5 col-md-5 col-lg-3 mx-1 my-2 py-3 text-light text-center bg-primary">
					   <?php
						$sql1 = "SELECT * FROM admin";
                        $query1 = mysqli_query($connection, $sql1);
                        $count1 = mysqli_num_rows($query1);
                        ?>
						<h1 class="pt-3"><?php echo $count1?></h1>
						<div class="pt-2 card-title text-center">
							<h5>Admins</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="application/javascript" src=../js/main.js></script>

</html>
