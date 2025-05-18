<?php
require_once("../database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/admin.css?v=1.0">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<title>Payment</title>
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
			<div class="container pb-5">
				<div class="col-12 mb-5">
					<div class="card my-2">
						<div class="card-header bg-secondary text-white text-center">
							<h3 class="fw-bolder">PAYMENTS</h3>
						</div>
						<div class="card-body">
							<table class="table table-hover" id="tabletbl">
								<thead>
									<tr>
										<th>PAYMENT ID</th>
										<th>CUSTOMER ID</th>
										<th>AMOUNT PAID</th>
										<th>MOP</th>
										<th>ACTION</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// to get data from database
									$sql = "SELECT * FROM payment";
									$query = mysqli_query($connection,$sql,);

									while($row = mysqli_fetch_assoc($query)){
									$pay_id = $row['pay_id'];
									$cust_id = $row['cust_id'];
									$total_amount = $row['total_amount'];
									$mop = $row['mop'];

									?>
									<tr>
										<td><?php echo $pay_id?></td>
										<td><?php echo $cust_id?></td>
										<td><?php echo $total_amount?></td>
										<td><?php echo $mop?></td>
										<td>
											<buttton type="button" class="btn btn-primary" id="viewbtn" name="viewbtn" data-bs-toggle="modal" data-bs-target="#viewModal" data-pay_id="<?php echo $pay_id;?>" data-cust_id="<?php echo $cust_id;?>" data-total_amount="<?php echo $total_amount?>" data-mop="<?php echo $mop;?>">View</buttton>
										</td>
									</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--View Modal-->
	<div class="modal fade" id="viewModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Payment Details</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<table class="table table-hover mb-4">
						<tbody>
							<tr>
								<td>
									<p>Payment ID: </p>
								</td>
								<td><b id="v_payID"></b></td>
							</tr>
							<tr>
								<td>
									<p>Customer ID: </p>
								</td>
								<td><b id="v_custID"></b></td>
							</tr>
							<tr>
								<td>
									<p>:Amount Paid: </p>
								</td>
								<td><b id="v_amountPaid"></b></td>
							</tr>
							<tr>
								<td>
									<p>MODE OF PAYMENT: </p>
								</td>
								<td><b id="v_mop"></b></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script>
$(function(){
	$(document).on('click', '#viewbtn', function() {
			var pay_id = $(this).data('pay_id');
			var cust_id = $(this).data('cust_id');
			var total_amount = $(this).data('total_amount');
			var mop = $(this).data('mop');

			//alert(course);
			$("#v_payID").text(pay_id);
			$("#v_custID").text(cust_id);
			$("#v_amountPaid").text(total_amount);
			$("#v_mop").text(mop);
			
		});
	$(document).on('click', '#closebtn', function() {
		$("#viewModal").modal('hide');
	});
	
});
</script>
</html>
