<?php

require_once("../../database.php");
session_start();

$food_id = $_POST['food_id'];
$quantity = $_POST['quantity'];
$cust_id = $_SESSION['cust_id'];
$amount = 0;

$sql = "DELETE FROM order_junction
	WHERE food_id='$food_id'
	AND cust_id='$cust_id'";
$query = mysqli_query($connection, $sql);

header("location:../../viewOrder.php");