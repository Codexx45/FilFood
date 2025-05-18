<?php
echo "what the fuck";
require_once("../../database.php");
session_start();

$cust_id = $_SESSION['cust_id'];
$table_num = $_SESSION['table_num'];
$mop = $_POST['mop'];


$sql = "INSERT INTO payment (cust_id, total_amount, mop)
            values ('$cust_id',
	        (SELECT sum(amount) FROM order_junction WHERE cust_id='$cust_id'),
	        '$mop')";
$query = mysqli_query($connection, $sql);

unset($_SESSION['cust_id']);
unset($_SESSION['table_num']);
header("location:../../index.php");
