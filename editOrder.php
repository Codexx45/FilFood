<?php

require_once("database.php");
session_start();

$cust_id = $_SESSION['cust_id'];

if(!isset($_GET['category'])){
    $thisCategory = "category";
}
else
    $thisCategory = "'".$_GET['category']."'";
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
							<a class="nav-link" href="food.php">FOOD</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="viewOrder.php" href="viewcart.php">
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
				<div class="card shadow">
					<div class="card-header bg-white text-dark py-3">
						<h1 class="fw-lighter">Edit Order</h1>
					</div>
					<div class="card-body">
						<table class="table table-hover text-start">
							<tbody>
								<?php
                        $this_cust_id = $_SESSION['cust_id'];
                        $this_food_id=$_POST['food_id'];
                        $sql = "SELECT  food.food_id,
                                        food.food_name,
                                        food.food_image,
                                        unit_price,
                                        quantity,
                                        amount
                                        FROM order_junction
                                            INNER JOIN food ON order_junction.food_id=food.food_id
                                        WHERE (cust_id ='$this_cust_id' AND food.food_id = '$this_food_id')";
                        $query = mysqli_query($connection, $sql);
                        $count=0;
                        while($row = mysqli_fetch_assoc($query)){
                            $food_id = $row['food_id'];
                            $food_name = $row['food_name'];
                            $food_image = $row['food_image'];
                            $unit_price = $row['unit_price'];
                            $quantity = $row['quantity'];
                            $amount = $row['amount'];
                            $count++;
                            ?>
								<form action="admin/php-operations/updateOrder.php" method="post">
									<tr>
										<td rowspan="6"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($food_image);?>" class="img-fluid shop-item-image rounded-3 shadow-lg"   style="width:100%; min-width: 250px; max-height:300px; object-fit: cover;"></td>
									</tr>
									<tr>
										<td colspan="2" class="align-middle">
											<h1><?php echo $food_name; ?></h1>
									</tr>
									<tr>
										<td class="align-middle">Price:</td>
										</td>
										<td class="align-middle"> &#8369;<?php echo $unit_price; ?></td>
									</tr>
									<tr>
										<td class="align-middle">Quantity:</td>
										<td class="align-middle"><input id="quantity" type="number" min="0" step="1" class="form-control" name="quantity" value="<?php echo $quantity; ?>"></td>
									</tr>
									<tr>
										<td colspan="2" class="align-middle">
											<div class="d-flex justify-content-center gap-2" style="display: inline-block">
												<input id="food_id" name="food_id" value="<?php echo $food_id; ?>" hidden>
												<input id="editbtn" type="submit" class="btn btn-sm btn-success p-2 px-4 rounded-pill dropdown-toggle" style="max-width:100px" value="Update" onclick="return confirm('Are you sure you want to update <?php echo $food_name; ?>?')">
											</div>
										</td>
									</tr>
								</form>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="card-footer d-flex justify-content-between">
						<a href="viewOrder.php" class="btn btn-sm bg-danger text-light rounded-pill p-2 px-3"><i class="bi bi-arrow-left pe-2"></i>Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
