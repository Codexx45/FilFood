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
	<title>Admin</title>
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
							<h3>MANAGE ADMIN</h3>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-start mb-2">
								<button class="btn btn-primary rounded-pill text-right" type="button" data-bs-toggle="modal" data-bs-target="#addModal">ADD <i class="bi bi-plus-lg"></i></button>
							</div>
							<table class="table table-hover" id="tabletbl">
								<thead>
									<tr>
										<th>ADMIN ID</th>
										<th>USERNAME</th>
										<th>PASSWORD</th>
										<th>FIRST NAME</th>
										<th>MIDDLE NAME</th>
										<th>LAST NAME</th>
										<th>ACTION</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// to get data from database
									$sql = "SELECT * FROM admin";
									$query = mysqli_query($connection, $sql,);

									while ($row = mysqli_fetch_assoc($query)) {
										$admin_id = $row['admin_id'];
										$username = $row['username'];
										$password = $row['password'];
										$fname = $row['admin_fname'];
										$mname = $row['admin_mname'];
										$lname = $row['admin_lname'];

									?>
										<tr>
											<td><?php echo $admin_id ?></td>
											<td><?php echo $username ?></td>
											<td><?php echo $password ?></td>
											<td><?php echo $fname ?></td>
											<td><?php echo $mname ?></td>
											<td><?php echo $lname ?></td>
											<td>
												<div class="dropdown">
													<button class="btn btn-primary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
														OPTIONS
													</button>
													<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
														<li>
															<a type="button" class="dropdown-item" id="editbtn" name="editbtn" data-bs-toggle="modal" data-bs-target="#editModal" data-admin_id="<?php echo $admin_id; ?>" data-username="<?php echo $username; ?>" data-password="<?php echo $password ?>" data-fname="<?php echo $fname; ?>" data-mname="<?php echo $mname; ?>" data-lname="<?php echo $lname; ?>">Edit</a>
														</li>
														<li>
															<a type="button" class="dropdown-item" id="deletebtn" data-id="<?php echo $admin_id; ?>">Delete</a>
														</li>
														<li>
															<a type="button" class="dropdown-item" id="viewbtn" name="viewbtn" data-bs-toggle="modal" data-bs-target="#viewModal" data-admin_id="<?php echo $admin_id; ?>" data-username="<?php echo $username; ?>" data-password="<?php echo $password ?>" data-fname="<?php echo $fname; ?>" data-mname="<?php echo $mname; ?>" data-lname="<?php echo $lname; ?>">View</a>
														</li>
													</ul>
												</div>
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
	<!--ADD Modal -->
	<div class="modal fade" id="addModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Add Admin</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<table class="table table-hover mb-4">
						<tbody>
							<tr>
								<td>
									<p>Username: </p>
								</td>
								<td><input type="text" class="form-control" id="username" name="username" required>
								</td>
							</tr>
							<tr>
								<td>
									<p>Password: </p>
								</td>
								<td><input type="password" class="form-control" id="password" name="password" required></td>
							</tr>
							<tr>
								<td>
									<p>First Name: </p>
								</td>
								<td>
									<input type="text" class="form-control" id="fname" name="fname" required>
								</td>
							</tr>
							<tr>
								<td>
									<p>Middle Name: </p>
								</td>
								<td>
									<input type="text" class="form-control" id="mname" name="mname" required>
								</td>
							</tr>
							<tr>
								<td>
									<p>Last Name: </p>
								</td>
								<td>
									<input type="text" class="form-control" id="lname" name="lname" required>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
						<button type="button" class="btn btn-primary text-white" id="addbtn">ADD <i class="fa-solid fa-floppy-disk"></i></button>
						<button type="reset" class="btn btn-primary text-white" name="cancel" id="cancelbtn">CANCEL <i class="fa-solid fa-xmark"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Edit Modal -->
	<div class="modal fade" id="editModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Edit Admin</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<table class="table table-hover mb-4">
						<tbody>
							<tr>
								<input type="hidden" class="form-control" id="e_adminid" name="e_adminid">
								<td>
									<p>Username: </p>
								</td>
								<td><input type="text" class="form-control" id="e_username" name="e_username" required>
								</td>
							</tr>
							<tr>
								<td>
									<p>Password: </p>
								</td>
								<td><input type="password" class="form-control" id="e_password" name="e_password" required></td>
							</tr>
							<tr>
								<td>
									<p>First Name: </p>
								</td>
								<td>
									<input type="text" class="form-control" id="e_fname" name="e_fname" required>
								</td>
							</tr>
							<tr>
								<td>
									<p>Middle Name: </p>
								</td>
								<td>
									<input type="text" class="form-control" id="e_mname" name="e_mname" required>
								</td>
							</tr>
							<tr>
								<td>
									<p>Last Name: </p>
								</td>
								<td>
									<input type="text" class="form-control" id="e_lname" name="e_lname" required>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
						<button type="button" class="btn btn-primary text-white" id="updatebtn">UPDATE <i class="fa-solid fa-floppy-disk"></i></button>
						<button type="reset" class="btn btn-primary text-white" name="cancel" id="cancelbtn">CANCEL <i class="fa-solid fa-xmark"></i></button>
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
					<h4 class="modal-title">Admin Details</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<table class="table table-hover mb-4">
						<tbody>
							<tr>
								<td>
									<p>Admin ID: </p>
								</td>
								<td><b id="v_adminid"></b></td>
							</tr>
							<tr>
								<td>
									<p>Username: </p>
								</td>
								<td><b id="v_username"></b></td>
							</tr>
							<tr>
								<td>
									<p>Password: </p>
								</td>
								<td><b id="v_password"></b></td>
							</tr>
							<tr>
								<td>
									<p>First Name: </p>
								</td>
								<td><b id="v_fname"></b></td>
							</tr>
							<tr>
								<td>
									<p>Middle Name: </p>
								</td>
								<td><b id="v_mname"></b></td>
							</tr>
							<tr>
								<td>
									<p>Last Name: </p>
								</td>
								<td><b id="v_lname"></b></td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
						<button type="button" class="btn btn-primary text-white" name="cancel" id="closebtn">CLOSE <i class="fa-solid fa-xmark"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script>
	$(function() {
		//add Admin
		$(document).on('click', '#addbtn', function() {
			var username = $("#username").val();
			var password = $("#password").val();
			var fname = $("#fname").val();
			var mname = $("#mname").val();
			var lname = $("#lname").val();

			if (username == "") {
				alertDialog("Error", "Please Enter Username!", "error");
				return; //stop
			}
			if (password == "") {
				alertDialog("Error", "Please Enter Password!", "error");
				return; //stop
			}
			if (fname == "") {
				alertDialog("Error", "Please Enter First Name!", "error");
				return; //stop
			}
			if (mname == "") {
				alertDialog("Error", "Please Enter Middle Name!", "error");
				return; //stop
			}
			if (lname == "") {
				alertDialog("Error", "Please Enter Last Mame!", "error");
				return; //stop
			}

			Swal.fire({
				title: 'Are you sure you want to add this new Admin?',
				text: "This will add new entry in the database",
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Ok'
			}).then((result) => {
				if (result.isConfirmed) {
					addstudent(username, password, fname, mname, lname);
				}
			});

		});

		function addstudent(username, password, fname, mname, lname) {
			var values = {
				"username": username,
				"password": password,
				"fname": fname,
				"mname": mname,
				"lname": lname
			};
			$.ajax({
				type: "POST",
				url: "php-operations/admin_add.php",
				data: values,
				cache: false,
				success: function(data) {
					if (data == "failed") {
						alertDialog("Error", "The Admin already exist! Please try again!", "error");
					} else {
						showaddedSuccess();
					}

				}
			});
		}
		//END

		//Edit Admin
		$(document).on('click', '#editbtn', function() {
			var admin_id = $(this).data('admin_id');
			var username = $(this).data('username');
			var password = $(this).data('password');
			var fname = $(this).data('fname');
			var mname = $(this).data('mname');
			var lname = $(this).data('lname');

			//alert(course);
			$("#e_adminid").val(admin_id);
			$("#e_username").val(username);
			$("#e_password").val(password);
			$("#e_fname").val(fname);
			$("#e_mname").val(mname);
			$("#e_lname").val(lname);

		});
		$(document).on('click', '#updatebtn', function() {
			var upd_adminid = $("#e_adminid").val();
			var upd_username = $("#e_username").val();
			var upd_password = $("#e_password").val();
			var upd_fname = $("#e_fname").val();
			var upd_mname = $("#e_mname").val();
			var upd_lname = $("#e_lname").val();

			if (upd_username == "") {
				alertDialog("Error", "Please Enter Username!", "error");
				return; //stop
			}
			if (upd_password == "") {
				alertDialog("Error", "Please Enter Password!", "error");
				return; //stop
			}
			if (upd_fname == "") {
				alertDialog("Error", "Please Enter First Name!", "error");
				return; //stop
			}
			if (upd_mname == "") {
				alertDialog("Error", "Please Enter Middle Name!", "error");
				return; //stop
			}
			if (upd_lname == "") {
				alertDialog("Error", "Please Enter Last Mame!", "error");
				return; //stop
			}

			Swal.fire({
				title: 'Are you sure you want to update this Admin?',
				text: "Updating this will not undo changes",
				icon: 'question',
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					updateAdmin(upd_adminid, upd_username, upd_password, upd_fname, upd_mname, upd_lname);

				}
			});

		});

		function updateAdmin(upd_adminid, upd_username, upd_password, upd_fname, upd_mname, upd_lname) {
			var values = {
				"upd_adminid": upd_adminid,
				"upd_username": upd_username,
				"upd_password": upd_password,
				"upd_fname": upd_fname,
				"upd_mname": upd_mname,
				"upd_lname": upd_lname
			};
			$.ajax({
				type: "POST",
				url: "php-operations/admin_edit.php",
				data: values,
				cache: false,
				success: function(data) {

					if (data == "success") {
						showUpdateSuccess();

					} else {
						alertDialog("Error", "The admin was not updated", "error")
					}

				}
			});
		}
		//  END

		// view modal
		$(document).on('click', '#viewbtn', function() {
			var admin_id = $(this).data('admin_id');
			var username = $(this).data('username');
			var password = $(this).data('password');
			var fname = $(this).data('fname');
			var mname = $(this).data('mname');
			var lname = $(this).data('lname');

			//alert(course);
			$("#v_adminid").text(admin_id);
			$("#v_username").text(username);
			$("#v_password").text(password);
			$("#v_fname").text(fname);
			$("#v_mname").text(mname);
			$("#v_lname").text(lname);


		});

		$(document).on('click', '#deletebtn', function() {
			var admin_id = $(this).data('id');

			Swal.fire({
				title: 'Are You Sure You Want To Delete This Admin?',
				text: "Deleteting this will not undo changes in the database",
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Ok'
			}).then((result) => {
				if (result.isConfirmed) {
					deleteAdmin(admin_id);
				}
			});

		});

		function deleteAdmin(admin_id) {
			var values = {
				"admin_id": admin_id

			};

			$.ajax({
				type: "GET",
				url: "php-operations/admin_delete.php",
				data: values,
				cache: false,
				success: function(data) {
					if (data == "success") {
						showDeleteSuccess();
					} else {
						alertDialog("Error", "The Admin was not deleted", "error");
					}
				}

			});
		}

		function showaddedSuccess() {
			Swal.fire({
				icon: 'success',
				title: 'Successful',
				text: 'Admin was Added',
				confirmButtonText: 'CONTINUE',
				allowEscapeKey: true,
				allowOutsideClick: true,
			}).then((result) => {
				if (result.isConfirmed) {
					location.reload(true);

				}

			})
		}

		function showUpdateSuccess() {
			Swal.fire({
				icon: 'success',
				title: 'Updated',
				text: 'Existing Student updated',
				confirmButtonText: 'CONTINUE',
				allowEscapeKey: false,
				allowOutsideClick: false,
			}).then((result) => {
				if (result.isConfirmed) {
					location.reload(true);

				}

			})
		}

		function showDeleteSuccess() {
			Swal.fire({
				icon: 'success',
				title: 'Deleted',
				text: '1 admin was successfully deleted',
				confirmButtonText: 'CONTINUE',
				allowEscapeKey: false,
				allowOutsideClick: false,
			}).then((result) => {
				if (result.isConfirmed) {
					location.reload(true);

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