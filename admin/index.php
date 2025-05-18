<?php
require_once("../database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Filfood-SignIn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="container">
    <div class="mt-5 row">
        <div class="col-10 col-sm-10 col-md-8 col-lg-5 offset-1 offset-lg-4 offset-md-2 offset-sm-1">
            <div class="card mt-5">
                <form role="form">

                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center"> SIGN-IN </h2>
                    </div>
                    <div class="card-body">

                        <div class="mb-3 mt-3">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="password"> Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-grid">
                            <button type="button" class="btn btn-primary btn-md" name="login" id="loginbtn">LOG IN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(function() {

        $("#loginbtn").click(function() {
            var username = $("#username").val();
            var password = $("#password").val();

            if (username == "") {
                alertDialog("error", "ERROR", "Please Enter Your Username!");
                return; //stop
            }
            if (password == "") {
                alertDialog("error", "ERROR", "Please Enter Your Password!");
                return; //stop
            }

            checkLogin(username, password);


        });

        function checkLogin(username, password) {

            var values = {
                "username": username, //variable name: value
                "password": password
            };
            $.ajax({
                type: "POST",
                url: "php-operations/checklogin.php",
                data: values,
                cache: false,
                success: function(data) {
                    if (data == "success")
                        gotoNewPage();
                    if (data == "invalid")
                        alertDialog("error", "ERROR", "Invalid Creditials Entered :");
                }

            });

        }

        function gotoNewPage() {
            Swal.fire({
                icon: 'success',
                title: 'Congratulations',
                text: 'You have logged in successfully',
                confirmButtonText: 'CONTINUE',
                allowEscapeKey: false,
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = 'admin_dashboard.php';

                }

            })
        }

        function alertDialog(icon, title, content) {
            Swal.fire(
                title,
                content,
                icon
            )
        }

    });

</script>

</html>
