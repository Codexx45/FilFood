<?php
require_once("database.php");
session_start();



if(isset($_SESSION['cust_id']))
    header("location:food.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>CST5L - Final Project</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css?v1.0">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-color">
	<div class="container-fluid mb-5">
		<div class="bg-color2 text-center text-white col-12 rounded shadow-lg py-2 ">
			<h1 class="display-1">FilFood</h1>
			<h4><i class="text-warning">The Classic Taste of Filipino Dish</i></h4>
		</div>
		<div class="row mt-5">
			<div class="col-10 col-sm-10 col-md-8 col-lg-4 offset-1 offset-sm-1 offset-md-2 offset-lg-4">
				<div class="card">
					<form action="dashboard.php" method="post">
						<div class="card-header text-white bg-secondary">
							<h2 class="text-center">CUSTOMER TABLE</h2>
						</div>
						<div class="card-body">
							<div class="mt-3">
								<label for="tablenum">
									<h5>Enter Table Number:</h5>
								</label>
								<input type="number" class="form-control" min="1" max="20" id="table_num" placeholder="Enter Table Number" name="tablenum" required>

								<div class=" mt-3 d-flex justify-content-end">
									<button class="btn btn-primary" type="button" name="login" id="addbtn">CONTINUE</button>
								</div>

							</div>
						</div>
					</form>
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
<script>
	$(function() {

		$(document).on('click', '#addbtn', function() {
			var table_num = $("#table_num").val();

			if (table_num == "") {
				alertDialog("Error", "Please Enter Table Number!", "error");
				return; //stop
			}
			if (table_num > 20) {
				alertDialog("Error", "Table Number Doesn't Exist!", "error");
				return; //stop
			}

			Swal.fire({
				title: 'Are You Sure The Table Number is Correct?',
				text: "",
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Ok'
			}).then((result) => {
				if (result.isConfirmed) {
					addtable(table_num);
				}
			});

		});

		function addtable(table_num) {
			var values = {
				"table_num": table_num,
			};
			$.ajax({
				type: "POST",
				url: "admin/php-operations/addTableNum.php",
				data: values,
				cache: false,
				success: function(data) {
					
					if (data == "success") {
						showaddedSuccess();
						
					} else {
						alertDialog("Error", "Table Number is not available", "error");
					}

				}
			});
		}
		//END
		function showaddedSuccess() {
			Swal.fire({
				icon: 'success',
				title: 'Successful',
				text: 'Welcome To Filfood!',
				confirmButtonText: 'CONTINUE',
				allowEscapeKey: true,
				allowOutsideClick: true,
			}).then((result) => {
				if (result.isConfirmed) {
					location.href = 'dashboard.php';

				}

			})
		}
		
		function alertDialog(title, content, icon) {
			Swal.fire(
				title,
				content,
				icon
			)
		}



	});

</script>

</html>
