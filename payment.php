<?php

require_once("database.php");
session_start();

$table_num = $_SESSION['table_num'];
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
    <title>Add New Entry</title>
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
<body class="bg-secondary" style="min-width: 350px;">

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
                            <li><a href="?category=main%20course" class="dropdown-item">Main Course</a></li>
                            <li><a href="?category=dessert" class="dropdown-item">Dessert</a></li>
                            <li><a href="?category=drinks" class="dropdown-item">Drinks</a></li>
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
    <div class="row justify-content-center mx-md-0 mx-3 mt-4">
        <div class="col-md-6 col-sm-10">
            <div class="card">
                <div class="card-header bg-white text-dark py-3"><h1 class="fw-lighter">Checkout</h1></div>
                <div class="card-body">
                    <div class="row">
                        <div class="container order-2 order-sm-1 col-sm-6 col-12 gap-3">
                            <h2>Receipt #<?php echo $cust_id; ?></h2>
                            <h6 class="fw-normal">Table #<?php echo $table_num; ?><br><br>
                                Payment date:<br> <?php echo date(DATE_RFC822); ?><br>
                                <br>Mode of Payment:</h6>
                            <form action="admin/php-operations/addNewPayment.php" method="post">
                                <div class="input-group">
                                    <select id="mop" name="mop" class="form-select" required>
                                        <option value="" selected disabled> Select a payment method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="GCash">GCash</option>
                                        <option value="Paymaya">PayMaya</option>
                                        <option value="BDO">BDO</option>
                                    </select>
                                    <input type="submit" class="btn btn-success btn-sm" value="Checkout">
                                </div>
                            </form>
                        </div>
                        <div class="container order-1 order-sm-2 col-12 col-sm-6">
                            <table class="table table-sm table-bordered text-center">
                                <thead>
                                <tr>
                                    <th colspan="4">Order Summary</th>
                                </tr>
                                </thead>
                                <tbody style="font-size: 10px">
                                <tr>
                                    <td>Item</td>
                                    <td>Unit Price</td>
                                    <td>Quantity</td>
                                    <td>Amount</td>
                                </tr>
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
                                        <td><?php echo $food_name; ?></td>
                                        <td><?php echo $unit_price; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo $amount; ?></td>

                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                            <div class="text-end">
                                <h3>Total: &#8369;<?php echo $total?></h3>
                                <h6>Number of Orders: <?php echo $count?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="viewOrder.php" class="btn btn-sm btn-danger text-light rounded-pill p-2 px-3"><i class="bi bi-arrow-left pe-2"></i>Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>