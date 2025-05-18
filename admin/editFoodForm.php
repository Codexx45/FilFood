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
    $food_id = $_GET['food_id'];

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Update Dish</title>
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
                <div class="col-11 col-sm-11 col-md-9 col-lg-9 ms-4 ms-sm-2 mb-5">
                    <div class="card mb-5">
                        <div class="card-header bg-white text-dark py-3">
                            <h1 class="fw-lighter">Edit <?php echo $food_name ?> Entry</h1>
                        </div>
                        <form method="post" action="php-operations/updateFoodEntry.php" enctype="multipart/form-data">
                            <div class="card-body px-5">
                                <div class="form-group px-md-2 px-sm-1 w-100">
                                    <label for="food_name" class="form-label">Food Name:</label>
                                    <input id="food_name" name="food_name" type="text" class="form-control mb-3" value="<?php echo $food_name ?>" required>
                                    <input id="food_id" name="food_id" type="text" class="form-control" value="<?php echo $food_id ?>" hidden readonly>
                                    <input id="food_id" name="food_id" type="text" class="form-control" value="<?php echo $food_id ?>" hidden readonly>

                                    <label for="category" class="category">Select Category:</label>
                                    <select id="category" value="<?php echo $category;?>" name="category" class="form-select mb-3" required>
                                        <option value="" disabled> Select a category</option>
                                        <option value="Appetizer" <?php if($category=="Appetizer") echo "selected" ?>>Appetizer</option>
                                        <option value="Main Dish" <?php if($category=="Main Dish") echo "selected" ?>>Main Dish</option>
                                        <option value="Dessert" <?php if($category=="Dessert") echo "selected" ?>>Dessert</option>
                                        <option value="Beverage" <?php if($category=="Beverage") echo "selected" ?>>Beverage</option>
                                    </select>

                                    <label for="item_price" class="form-label">Item Price: </label>
                                    <input id="unit_price" value="<?php echo $unit_price ?>" name="unit_price" type="number" step="0.01" min="1" class="form-control mb-3" required>

                                    <label for="image" class="form-label">Food Image:</label>
                                    <br>
                                    <button type="button" class="border-0 p-0 m-0 bg-white position-relative" id="current_food_image">
                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($food_image);?>" class="position-relative img-fluid rounded shop-item-image mb-2 " style="width: 200px; height: 150px; object-fit: cover;">
                                        <a class="position-absolute btn btn-danger top-0 start-100 translate-middle badge rounded-pill" id="removeImage">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    </button>

                                    <input type="file" id="food_image" name="food_image" value="null" class="form-control invisible" accept="image/*">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-grid gap-2 d-flex justify-content-between">
                                    <a href="foodAdmin.php" class="btn btn-sm btn-danger text-light rounded-pill p-2 px-3"><i class="bi bi-arrow-left pe-2"></i>Back</a>
                                    <button type="submit" class="btn btn-success fw-bold" id="submitbtn"><i class="bi bi-upload"> &nbsp;</i> SAVE CHANGES</button>
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
    $(function () {

        <?php if(isset($_SESSION['error'])) {?>
        Swal.fire(
            'Error',
            '<?php echo $_SESSION['error']; ?>',
            'error'
        );
        <?php } unset($_SESSION['error'])?>

        $("#food_image").hide();
        /*$("#submitbtn").click(function () {
            var food_name = $("#").val();
            var food_id = $("#food_id").val();
            var food_image = $("#food_image").val();
            var unit_price = $("#unit_price").val();
            var category = $("#category").val();

            editFoodEntry(food_id, food_name, unit_price, category, food_image)
        });

        function editFoodEntry(food_id, food_name, unit_price, category, food_image){
            var data = {
                "food_name": food_name,
                "food_id": food_id,
                "food_image": food_image,
                "unit_price": unit_price,
                "category": category
            }

            $.ajax({
               type: "POST",
               url: "php-operations/updateFoodEntry.php",
                data:data,
                cache: "false",
                success: function (data) {
                    alert(data);
                }
            });
        }*/

        $("#removeImage").click(function () {
            Swal.fire({
                title: 'Remove image?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#current_food_image").hide();
                    $("#food_image").show();
                    $("#food_image").toggleClass("mb-3 invisible");
                    document.getElementById("food_image").required = true;
                }
            })
        });

    });

</script>

</html>
