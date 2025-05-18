<?php
require_once("../database.php");
session_start();

if(!isset($_GET['category'])){
    $thisCategory = "category";
}
else
    $thisCategory = "'".$_GET['category']."'";

if(isset($_POST['food_id']))
    $food_id = $_POST['food_id'];
else
    $food_id = '1';

$sql = "SELECT * FROM food WHERE food_id = $food_id";
$query = mysqli_query($connection, $sql);
$count = 0;

while ($row = mysqli_fetch_assoc($query)) {
    $food_id = $row['food_id'];
    $food_name = $row['food_name'];
    $food_image = $row['food_image'];
    $category = $row['category'];
    $unit_price = $row['unit_price'];
    $count++;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/admin.css?v=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<title>Add Dish</title>
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
			<div class="container-fluid">
				<div class="row offset-sm-1 offset-md-2 offset-lg-3">
					<div class="col-11 col-sm-11 col-md-9 col-lg-8 ms-4 ms-sm-2 mb-5">
						<div class="card mb-5">
							<div class="card">
								<div class="card-header bg-white text-dark py-3">
									<h1 class="fw-lighter">Add New Food Entry</h1>
								</div>
								<form action="php-operations/addNewFood.php" method="post" enctype="multipart/form-data">
									<div class="card-body px-5">
										<div class="form-group px-md-2 px-sm-1 w-100">
											<label for="food_name" class="form-label">Food Name:</label>
											<td><input id="food_name" name="food_name" type="text" class="form-control" required></td>

											<label for="category" class="category">Select Category:</label>
											<select id="category" name="category" class="form-select" required>
												<option value="" selected disabled> Select a category</option>
												<option value="Appetizer">Appetizer</option>
												<option value="Main Dish">Main Dish</option>
												<option value="Dessert">Dessert</option>
												<option value="Beverage">Beverage</option>
											</select>

											<label for="item_price" class="form-label">Item Price: </label>
											<input id="unit_price" name="unit_price" type="number" step="0.01" min="1" class="form-control" required>

											<label for="image" class="form-label">Select Image:</label>
											<br>
											<input type="file" id="food_image" name="food_image" class="form-control" accept="image/*" required>
										</div>
									</div>
									<div class="card-footer">
										<div class="d-grid gap-2 d-flex justify-content-between">
											<a href="foodAdmin.php" class="btn btn-sm btn-danger text-light rounded-pill p-2 px-3"><i class="bi bi-arrow-left pe-2"></i>Back</a>
											<button type="submit" class="btn btn-success fw-bold" onclick="return confirm('Are you sure you want to add this new dish to the database?')"><i class="bi bi-upload"> &nbsp;</i> ADD</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
<script type="application/javascript" src=../js/main.js></script>
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
