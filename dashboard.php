<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="css/style.css?v=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<title>Filfood</title>
</head>

<body>
	<nav class="navbar navbar-expand-lg fixed-top navbar-dark px-5" style="background-color: #343a40;">
		<div class="container-fluid">
			<a class="navbar-brand" href="#"> <img src="img/logo.png" alt="Logo" class="rounded-circle mx-2" style="height: 30px; width:30px;">Filfood</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse float-end" id="navbarSupportedContent">
				<ul class="nav nav-pills ms-auto fw-bold text-white">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="dashboard.php">HOME</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="food.php">FOOD</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="viewOrder.php">
							<h5><i class="bi bi-bag"></i></h5>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
		</div>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="img/lechon-kawali.jpg" class="d-block w-100" alt="Lechon Kawali" style="max-height: 670px;">
				<div class="carousel-caption d-none d-md-block text-black">
					<h5>Lechon Kawali</h5>
					<p>Some representative placeholder content for the first slide.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="img/pochero.jpg" class="d-block w-100" alt="Pochero" style="max-height: 670px;">
				<div class="carousel-caption d-none d-md-block text-black">
					<h5>Pochero</h5>
					<p>Some representative placeholder content for the second slide.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="img/crispy-pata.jpg" class="d-block w-100" alt="Crispy Pata" style="max-height: 659px;">
				<div class="carousel-caption d-none d-md-block text-black">
					<h5>Crispy Pata</h5>
					<p>Some representative placeholder content for the third slide.</p>
				</div>
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
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
<script>
	$(function() {

		load_cart_item_number();

		function load_cart_item_number() {
			$.ajax({
				method: "GET",
				url: "admin/php-operations/orderlist.php",
				data: {
					'cartItem': "cart_item"
				},
				success: function(data) {
					$("#cart-item").html(data);
				}
			});
		}
	});

</script>

</html>
