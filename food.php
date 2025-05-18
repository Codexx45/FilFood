<?php
require_once("database.php");
session_start();


if(!isset($_GET['category'])){
    $thisCategory = "category";
}
else
    $thisCategory = "'".$_GET['category']."'";



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Filfood | <?php echo $_SESSION['cust_id']; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<!--Bootstap Icon-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css" />
	<!--1) Owl Carousel css
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!--2) Owl Carousel theme-->
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=1.0">
	<link href="http://fonts.cdnfonts.com/css/circular-std" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<header>
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
							<a class="nav-link" href="viewOrder.php">
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
		<div class="container-fluid position-relative ">
			<div class="container-fluid position-relative d-inline-block bg-light shadow-lg">
				<div class="px-4 pt-5 mb-3 text-warning rounded-bottom shadow-lg " style="background-image: url('img/bg2.jpeg');
                    height: 350px; width: auto; background-repeat: no-repeat; background-size: cover;">
					<div class="position-absolute bottom-0 start-0 ms-5 mb-3">
						<h1 class="pt-3 fw-bolder" style="font-size: xxx-large">
							<?php

                            if(isset($_GET['category']))
                                echo "MENU: ".strtoupper($_GET['category']);
                            else
                                echo "ALL ITEMS";

                            ?>
						</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed aliquet velit. Vivamus mattis hendrerit rhoncus.</p>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section>
		<div class="container-fluid">
			<br>
			<div class="row justify-content-center">
				<div class="col-10">
					<div class="card mb-5">
						<div class="card-body">
							<table class="table table-hover text-center" id="tabletbl">
								<thead>
									<tr>
										<th>Name</th>
										<th>Image</th>
										<th>Category</th>
										<th>Price</th>
										<th>Order Now</th>
									</tr>
								</thead>
								<tbody>
									<?php
								   $sql = "SELECT * FROM food INNER JOIN menu ON food.food_id=menu.food_id WHERE category = $thisCategory AND date(menudate)=date(now())";
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
										<td>
											<h4 class="my-5"><?php echo $food_name; ?></h4>
										</td>
										<td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($food_image);?>" class="img-fluid shop-item-image my-2" style="width: 150px; height: 110px; object-fit: cover;"></td>
										<td>
											<h4 class="my-5"><?php echo $category; ?></h4>
										</td>
										<td>
											<h4 class="my-5"><?php echo $unit_price; ?></h4>
										</td>
										<td>
											<button id="btnGroupDrop2" type="button" class="btn btn-mb btn-outline-secondary p-2 px-3 my-5 rounded-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
												Order
											</button>
											<div class="dropdown-menu rounded" aria-labelledby="btnGroupDrop2 p-0 rounded-pill">
												<form method="post" action="admin/php-operations/addToCart.php">
													<div class="d-grid p-3">
														<h5 class="text-center">Quantity</h5>
														<input class="text-center" id="food_id" name="food_id" value="<?php echo $food_id; ?>" hidden>
														<!--Increment Decrement Button-->
														<div class="input-group w-auto justify-content-center align-items-center">
															<input type="button" value="-" class="button-minus border rounded-circle  icon-shape btn btn-sm mx-1 bg-danger " data-field="quantity">
															<input type="number" step="1" min="1" max="1000" value="1" name="quantity" class="quantity-field border-0 text-center w-25 quantity">
															<input type="button" value="+" class="button-plus border rounded-circle icon-shape btn btn-sm bg-success" data-field="quantity">
														</div>
														<div class="input-group justify-content-center">
															<input type="submit" class="mt-2 btn btn-sm rounded-3 btn-outline-success m-0" style="width:100px" value="Add To Cart">
														</div>
													</div>
												</form>
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
</body>
<!--owl corousel
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script type="application/javascript" src="js/main.js"></script>

</html>
