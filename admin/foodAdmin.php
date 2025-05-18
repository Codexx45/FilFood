<?php
require_once("../database.php");
session_start();

if(!isset($_GET['category'])){
    $thisCategory = "category";
}
else
    $thisCategory = "'".$_GET['category']."'";

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
	<title>Food List</title>
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
			<div class="container-fluid ">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-10 mb-5">
						<div class="card mb-5">
							<div class="p-3 card-header d-flex flex-column">
								<?php if(isset($_GET['category'])){ ?>
								<h3 class="fw-lighter mb-0">MENU:</h3>
								<h1 class="fw-bolder" style="font-size: xxx-large">
									<?php echo strtoupper($_GET['category']); ?>
								</h1>
								<?php }
                                else {?>
								<h1 style="font-size: xxx-large">MENU</h1>
								<?php } ?>
							</div>
							<div class="card-body">
								<div class="d-flex d-flex justify-content-between mb-2">
									<a href="newFoodForm.php" class="btn btn-sm bg-danger text-light rounded-pill p-2 px-3"><i class="bi bi-plus-lg"></i> New Food Entry</a><span>
										<button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary p-2 px-3 rounded-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
											Show Courses
										</button>
										<ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
											<li><a href="?" class="dropdown-item">Show All</a></li>
											<li><a href="?category=appetizer" class="dropdown-item">Appetizer</a></li>
											<li><a href="?category=main%20dish" class="dropdown-item">Main Dish</a></li>
											<li><a href="?category=dessert" class="dropdown-item">Dessert</a></li>
											<li><a href="?category=beverage" class="dropdown-item">Beverage</a></li>
										</ul>
									</span>
								</div>
								<table class="table table-hover text-center" id="tabletbl">
									<thead>
										<tr>
											<th>Name</th>
											<th>Image</th>
											<th>Category</th>
											<th>Price</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM food WHERE category = $thisCategory";
										$query = mysqli_query($connection, $sql);
										$count=0;
										while($row = mysqli_fetch_assoc($query)){
											$food_id = $row['food_id'];
											$food_name = $row['food_name'];
											$food_image = $row['food_image'];
											$category = $row['category'];
											$unit_price = $row['unit_price'];
											$count++;
											?>
										<tr>
											<td><h5 class="my-5"><?php echo $food_name; ?></h5></td>
											<td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($food_image);?>" class="img-fluid shop-item-image" style="width: 200px; height: 150px; object-fit: cover;"></td>
											<td><h5 class="my-5"><?php echo $category; ?></h5></td>
											<td><h5 class="my-5"><?php echo $unit_price; ?></h5></td>

											<td>
												<!--<a href="#" id="view" class="btn btn-sm bg-secondary text-light rounded-pill p-1 px-3"><i class="bi bi-cart pe-2"></i>Actions</a>-->
												<div class="dropdown my-5">
													<button class="btn btn-primary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
														OPTIONS
													</button>
													<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
														<form method="post">
															<input id="food_id" name="food_id" value="<?php echo $food_id; ?>" hidden>
															<input id="food_name" name="food_name" value="<?php echo $food_name; ?>" hidden>
															<input id="category" name="quantity" value="<?php echo $category; ?>" hidden>
															<input id="unit_price" name="unit_price" value="<?php echo $unit_price; ?>" hidden>
															<li>
																<button type="submit" formaction="editFoodForm.php" class="dropdown-item" style="max-width:100px" onclick="return confirm('Are you sure you want to update <?php echo $food_name; ?>')">Update Entry</button>
															</li>
															<li>
																<button type="submit" formaction="php-operations/deleteFood.php" class="dropdown-item" style="max-width:100px" onclick="return confirm('Are you sure you want to delete <?php echo $food_name; ?>?')">Delete Entry</button>
															</li>
														</form>
													</ul>
												</div>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script>

    <?php if(isset($_SESSION['success'])) {?>
    Swal.fire(
        'Success',
        '<?php echo $_SESSION['success']; ?>',
        'success'
    );
    <?php } unset($_SESSION['success'])?>


    <?php if(isset($_SESSION['error'])) {?>
    Swal.fire(
        'Error',
        '<?php echo $_SESSION['error']; ?>',
        'error'
    );
    <?php } unset($_SESSION['error'])?>
</script>

</html>
