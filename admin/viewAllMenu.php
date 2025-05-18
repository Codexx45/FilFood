<?php
date_default_timezone_set("Asia/Manila");
require_once("../database.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

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
	<title>Menu's</title>
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
			<div class="container-fluid d-flex align-items-end text-warning rounded-bottom shadow-lg " style="background-image: url('../img/bg2.jpeg'); height: 25vh; width: auto; background-repeat: no-repeat; background-position: center; background-size: cover;">
				<div class="d-flex justify-content-center text-center container-fluid vw-100">
					<h1 style="text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
                                    0px 8px 13px rgba(0,0,0,0.1),
                                    0px 18px 23px rgba(0,0,0,0.1); font-size: 7vh; line-height: 6.5vh;">
						Menu History
					</h1>
				</div>
			</div>
			<section>
				<div class="container py-3">
					<div class="container d-flex justify-content-center">
						<?php
							$sql1 = "SELECT menudate FROM menu WHERE menudate=curdate()";
							$query1 = mysqli_query($connection, $sql1);
							$exist = mysqli_fetch_assoc($query1);
							if($exist==0){?>
						<a href="createTodaysMenu.php" class="btn rounded-pill btn-success btn-lg"><i class="bi bi-plus-lg"></i> Create today's menu</a>
						<?php 
						} 
						?>
					</div>
					<div class="container mt-3 py-3 rounded-3 shadow-lg bg-white">

						<table class="table text-center table-hover">
							<thead>
								<tr>
									<td>Date</td>
									<td>Menu List</td>
									<td>Action</td>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql = "SELECT DISTINCT menudate FROM menu ORDER BY menudate DESC";
									$query = mysqli_query($connection, $sql);

									while($row = mysqli_fetch_assoc($query)){
									$menudate = $row['menudate'];
									$menudate2 = date("Y M d",strtotime($menudate));
									?>
								<tr>
									<td style='width: 33%;'>
										<h2 class="pt-5"><?php echo $menudate2; ?>
											<?php if($menudate==date("Y-m-d")){ ?>
											<h5><span class="badge rounded-pill bg-success"><i>TODAY</i></span></h5>
											<?php } ?>
										</h2>
									</td>
									<td style='width: 33%;'>
										<?php
										$sql2 = "SELECT food_name FROM menu INNER JOIN food ON food.food_id=menu.food_id WHERE menu.menudate='$menudate' ORDER BY category, food_name";
										$query2 = mysqli_query($connection, $sql2);
										while($row2 = mysqli_fetch_assoc($query2)){
											$food_name = $row2['food_name'];
											?>
										<h6><?php echo $food_name; ?>
											<!--<label class="btn btn-outline-primary text-start py-3 w-100" for="food_<?php /*echo $food_id; */?>"><div class=" w-100" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><h2><?php /*echo $food_name; */?></h2></div><?php /*echo $category; */?><br>P<?php /*echo $unit_price; */?><hr><img src="data:image/jpg;charset=utf8;base64,<?php /*echo base64_encode($food_image);*/?>" style="width: 100%; height:150px; object-fit: cover"></label>-->
										</h6>
										<?php }
										echo "</td>";
										if($menudate==date("Y-m-d")){
										?>
									<td style='width: 33%;'>
										<div class="d-flex justify-content-center gap-2 pt-5" style="display: inline-block">
											<form method="post">
												<input id="menudate" name="menudate" value="<?php echo $menudate; ?>" hidden>
												<input id="updatemenu" type="submit" formaction="updateTodaysMenu.php" class="my-1 gap-1 btn btn-sm btn-outline-secondary p-2 px-4 rounded-pill dropdown-toggle" style="max-width:100px" value="Update" onclick="return confirm('Are you sure you want to update the menu?')">
												<input id="deletemenu" type="submit" formaction="php-operations/deleteTodaysMenu.php" class="my-1 gap-1 btn btn-sm btn-outline-secondary p-2 px-4 rounded-pill dropdown-toggle" style="max-width:100px" value="Delete" onclick="return confirm('Are you sure you want to delete the menu?')">
											</form>
										</div>
									</td>
									<?php } else
                        echo "<td>&nbsp;</td>";
                    echo "</tr>";
                    } ?>
							</tbody>
						</table>
					</div>
				</div>
			</section>
			<footer class="bg-dark text-white pt-5 pb-4">
				<div class="container text-center text-md-start">
					<div class="row text-center text-md-start">
						<div class="col-md-3 col-lg-3 col-xl-3 me-auto mt-3">
							<h5 class="mb-4 fw-bolder text-warning">
								OPENING HOURS
							</h5>
							<p>MONDAY------------9:00-11:00</p>
							<p>TUESDAY------------9:00-11:00</p>
							<p>WEDSNESDAY------9:00-11:00</p>
							<p>THURSDAY----------9:00-11:00</p>
							<p>FRIDAY--------------9:00-12:00</p>
							<p>SATURDAY----------9:00-12:00</p>
							<p>FRIDAY--------------9:00-9:00</p>
							<br>
						</div>
						<div class="col-md-3 col-lg-3 col-xl-3 me-auto mt-3">
							<h5 class="mb-4 fw-bolder text-warning">
								LOCATION
							</h5>
							<p>Manila</p>
							<p>Pasay</p>
							<p>Cebu</p>
							<p>Davao</p>
							<p>Quezon</p>
							<p>Cagayan</p>
						</div>
						<div class="col-md-3 col-lg-3 col-xl-3 me-auto mt-3">
							<h5 class="mb-4 fw-bolder text-warning">
								MENU
							</h5>
							<p><a href="user_dashboard.html" class="text-white text-decoration-none" style="text-style: none;">HOME</a></p>
							<p><a href="#" class="text-white text-decoration-none" style="text-style: none;">CATEGORIES</a></p>
							<p><a href="#" class="text-white text-decoration-none" style="text-style: none;">FOOD</a></p>
							<p><a href="#" class="text-white text-decoration-none" style="text-style: none;">ORDER</a></p>
						</div>
						<div class="col-md-3 col-lg-3 col-xl-3 me-auto mt-3">
							<h5 class="mb-4 fw-bolder text-warning">
								CONTACT
							</h5>
							<p>Phone: 0912-345-6789</p>
							<p>Tel #: 123-789</p>
							<p>Email: Filfood@gmail.com</p>
							<p>FOLLOW US ON</p>
							<ul class="list-unstyled list-group gap-4 list-group-horizontal-sm">
								<li>
									<a href="https://www.facebook.com/" class="list-group" target="_blank">
										<h5><i class="bi bi-facebook"></i></h5>
									</a>
								</li>
								<li>
									<a href="https://www.twitter.com/" class="list-group" target="_blank">
										<h5><i class="bi bi-twitter"></i></h5>
									</a>
								</li>
								<li>
									<a href="https://www.instagram.com/" class="list-group" target="_blank">
										<h5><i class="bi bi-instagram"></i></h5>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
</body>
<!--owl corousel
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script type="application/javascript" src="../js/main.js"></script>

</html>
