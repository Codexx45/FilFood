<?php

require_once("../../database.php");
session_start();

$food_id = $_POST['food_id'];
$food_name = $_POST['food_name'];
$amount = 0;


$sql1 = "SELECT * FROM order_junction WHERE food_id='$food_id'";
$query1 = mysqli_query($connection, $sql1);
$exists = mysqli_fetch_assoc($query1);

if($exists==0){
    $sql = "DELETE FROM food
	WHERE food.food_id='$food_id'";
    $query = mysqli_query($connection, $sql);
    $_SESSION['success']="The food record for $food_name has been deleted";
    header("location:../foodAdmin.php");
}else {
    $_SESSION['error']="The food record for $food_name is used on another table in the database. Entry cannot be deleted";
    header("location:../foodAdmin.php");
}