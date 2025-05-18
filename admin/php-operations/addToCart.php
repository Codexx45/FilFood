<?php

require_once("../../database.php");
session_start();

$food_id = $_POST['food_id'];
$quantity = $_POST['quantity'];
$cust_id = $_SESSION['cust_id'];
$amount = 0;


checkExists($food_id, $quantity, $cust_id, $amount, $connection);

function checkExists($food_id, $quantity, $cust_id, $amount, $connection){
    $sql = "SELECT food_id, quantity FROM order_junction WHERE food_id='$food_id' AND cust_id='$cust_id'";
    $query = mysqli_query($connection, $sql);
    $exists = mysqli_num_rows($query);

    if($exists>0){
        while($row = mysqli_fetch_assoc($query)) {
            $currentquantity = $row['quantity'];
            $quantity = $quantity + $currentquantity;
        }
        $sql1 = "SELECT unit_price FROM food WHERE food_id='$food_id'";
        $query1 = mysqli_query($connection, $sql1);
        $exists = mysqli_num_rows($query1);

        while($row = mysqli_fetch_assoc($query1)) {
            $unit_price = $row['unit_price'];
            $amount = $unit_price * $quantity;
        }

        if($amount!=0){
            $sql2 = "UPDATE order_junction
                        SET quantity = '$quantity',
                            amount = '$amount'
                        WHERE cust_id='$cust_id' AND food_id='$food_id';";
            $query2 = mysqli_query($connection, $sql2);
            header("location:../../viewOrder.php");
        }
    }else{
        $sql2 = "INSERT INTO order_junction (cust_id, food_id, quantity, amount)
                        SELECT '$cust_id',
                               '$food_id',
                               '$quantity',
                               $quantity*food.unit_price
                        FROM food WHERE food_id='$food_id'";
            $query2 = mysqli_query($connection, $sql2);
            header("location:../../viewOrder.php");
    }
}