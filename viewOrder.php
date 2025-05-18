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
	<style>
	</style>
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
		<div class="row justify-content-center my-4">
			<div class="col-md-8 col-sm-10">
				<div class="card">
					<div class="card-header bg-white text-dark py-3">
						<h1 class="fw-lighter">Customer #<?php echo $_SESSION['cust_id'];?>'s Cart</h1>
					</div>
					<div class="card-body">
						<table class="table table-hover text-center">
							<thead>
								<tr>
									<th>Item</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Amount</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
                        $cust_id = $_SESSION['cust_id'];
                        $sql = "SELECT  food.food_id,
                                        food.food_name,
                                        food.food_image,
                                        unit_price,
                                        quantity,
                                        amount
                                        FROM order_junction
                                            INNER JOIN food ON order_junction.food_id=food.food_id
                                        WHERE cust_id ='$cust_id'";
                        $query = mysqli_query($connection, $sql);
                        $count=0;
                        $total=0;
                        while($row = mysqli_fetch_assoc($query)){
                            $food_id = $row['food_id'];
                            $food_name = $row['food_name'];
                            $food_image = $row['food_image'];
                            $unit_price = $row['unit_price'];
                            $quantity = $row['quantity'];
                            $amount = $row['amount'];
                            $count++;
                            $total = $total+ $amount;
                            ?>
								<tr>
									<td><?php echo $food_name; ?><br><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($food_image);?>" class="img-fluid shop-item-image rounded-3 shadow" style="width: 200px; height: 150px; object-fit: cover;"></td>
									<td><?php echo $unit_price; ?></td>
									<td><?php echo $quantity; ?></td>
									<td><?php echo $amount; ?></td>
									<td>
										<div class="d-flex justify-content-center gap-2" style="display: inline-block">
											<form id="editform" method="post">
												<input id="food_id" name="food_id" value="<?php echo $food_id; ?>" hidden>
												<input id="food_name" name="food_name" value="<?php echo $food_name; ?>" hidden>
												<input id="quantity" name="quantity" value="<?php echo $quantity; ?>" hidden>
												<input id="editbtn" type="submit" formaction="editOrder.php" class="my-1 gap-1 btn btn-sm btn-outline-secondary p-2 px-4 rounded-pill dropdown-toggle" style="max-width:100px" value="Edit" onclick="return confirm('Are you sure you want to update <?php echo $food_name; ?>?')">
												<input id="deletebtn" type="submit" formaction="admin/php-operations/deleteFromCart.php" class="my-1 gap-1 btn btn-sm btn-outline-secondary p-2 px-4 rounded-pill dropdown-toggle" style="max-width:100px" value="Delete" onclick="return confirm('Are you sure you want to remove <?php /*echo $food_name; */?>?')">
											</form>
										</div>
									</td>

								</tr>
								<?php }?>
							</tbody>
						</table>
						<?php


                    if ($count == 0) {
                        echo "<h2 class='text-center p-5'>There are currently no orders.</h2>";
                    }else{
                    ?>
						<div class="d-flex justify-content-between">
							<a id="checkoutbtn" href="payment.php" class="gap-1 fw-bolder btn btn-lg btn-outline-success p-2 px-4 my-3 rounded-pill" value="" onclick="return confirm('Are you sure you want to checkout now?')"><i class='bi bi-cart-check-fill'> </i> Checkout</a>
							<div class="text-end">
								<h3>Total: &#8369;<?php echo $total?></h3>
								<h5>Number of Orders: <?php echo $count?></h5>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="card-footer d-flex justify-content-between">
						<a href="food.php" class="btn btn-sm btn-danger text-light rounded-pill p-2 px-3"><i class="bi bi-arrow-left pe-2"></i>Back</a>
						<!--<span>
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary p-2 px-3 rounded-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Show Courses
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a href="index.php/" class="dropdown-item">Show All</a></li>
                            <li><a href="index.php/?category=appetizer" class="dropdown-item">Appetizer</a></li>
                            <li><a href="index.php/?category=main%20course" class="dropdown-item">Main Course</a></li>
                            <li><a href="index.php/?category=dessert" class="dropdown-item">Dessert</a></li>
                            <li><a href="index.php/?category=drinks" class="dropdown-item">Drinks</a></li>
                        </ul>
                    </span>-->
					</div>
				</div>
			</div>
		</div>
	</div>
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
</body>

</html>
