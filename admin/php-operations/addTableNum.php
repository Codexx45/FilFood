<?php
require_once ("../../database.php");
session_start();

$table_num = $_POST['table_num'];
$_SESSION['table_num']=$table_num;
$order_date = date('Y-m-d H:i:s');


$sql = "INSERT INTO customer(table_num, order_date) VALUES ('$table_num', '$order_date')";
$query = mysqli_query($connection,$sql);

$getCustID = "SELECT * FROM customer WHERE table_num = '$table_num' AND order_date='$order_date'";
$query2 = mysqli_query($connection,$getCustID);
while($row = mysqli_fetch_assoc($query2)){
    $_SESSION['cust_id'] = $row['cust_id'];
}

echo "success";
