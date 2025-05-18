<?php

require_once("database.php");
session_start();

$cust_id = $_SESSION['cust_id'];

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
<html lang="en">

<head>
	<title>Orders &#0149; Customer <?php echo $cust_id; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="bg-secondary">
	<header class="mb-5">
		<nav class="navbar navbar-expand-lg fixed-top navbar-dark opacity-100 px-5" style="background-color: #343a40;">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Filfood</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse float-end" id="navbarSupportedContent">
					<ul class="nav nav-pills ms-auto fw-bold text-white">
						<li class="nav-item">
							<a class="nav-link " aria-current="page" href="dashboard.php">HOME</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								CATEGORIES
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a href="?" class="dropdown-item">Show All</a></li>
								<li><a href="?category=appetizer" class="dropdown-item">Appetizer</a></li>
								<li><a href="?category=main%20dish" class="dropdown-item">Main Dish</a></li>
								<li><a href="?category=dessert" class="dropdown-item">Dessert</a></li>
								<li><a href="?category=beverage" class="dropdown-item">Beverage</a></li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="food.php">FOOD</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="viewOrder.php" href="viewcart.php">
								<h5><i class="bi bi-bag"></i>
									<!--<span id="cart-item" class="ms-1 badge bg-secondary"></span>-->
								</h5>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!--Nav end-->
		<div class="container-fluid" style="z-index: -1; height: 150px; background-image: url('img/bg2.jpeg'); background-position: center;  filter: blur(30px); -webkit-filter: blur(30px); object-fit: cover; position: absolute;">&nbsp;</div>
	</header>

	<div class="container-fluid">
		<br>
		<div class="row justify-content-center">
			<div class="col-lg-4 col-sm-10 col-md-6">
				<div class="card">
					<div class="card-header bg-white text-dark py-3">
						<h1 class="fw-lighter">Edit <?php echo $food_name ?> Entry</h1>
					</div>
					<div class="card-body">
						<form action="php-operations/updateFoodEntry.php" method="post" enctype="multipart/form-data">
							<table class="table table-hover text-start">
								<tbody>
									<tr>
										<td>Name:</td>
										<td><input id="food_name" name="food_name" type="text" class="form-control" value="<?php echo $food_name ?>" required>
											<input id="food_id" name="food_id" type="text" class="form-control" value="<?php echo $food_id ?>" hidden readonly>
											<input id="food_id" name="food_id" type="text" class="form-control" value="<?php echo $food_id ?>" hidden readonly>
										</td>
									</tr>
									<tr>
										<td>Category:</td>
										<td>
											<select id="category" selected="<?php echo $category ?>" name="category" class="form-select" required>
												<option value="" disabled> Select a category</option>
												<option value="Appetizer">Appetizer</option>
												<option value="Main Dish">Main Dish</option>
												<option value="Dessert">Dessert</option>
												<option value="Beverage">Beverage</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Unit Price:</td>
										<td><input id="unit_price" value="<?php echo $unit_price ?>" name="unit_price" type="number" step="0.01" min="1" class="form-control" required></td>
									</tr>
									<tr>
										<td>Upload Image:</td>
										<td>
											<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($food_image);?>" class="img-fluid rounded shop-item-image mb-2 " style="width: 100%; height: 150px; object-fit: cover;">
											<input type="file" id="food_image" name="food_image" class="form-control">
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td class="d-flex justify-content-end"><button type="submit" class="btn btn-md btn-success rounded-pill px-4" value="SUBMIT" onclick="return confirm('Are you sure you want to update this dish?')"><i class="bi bi-upload"> &nbsp;</i> Submit</button></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
					<div class="card-footer d-flex justify-content-between">
						<a href="foodAdmin.php" class="btn btn-sm btn-danger text-light rounded-pill p-2 px-3"><i class="bi bi-arrow-left pe-2"></i>Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
