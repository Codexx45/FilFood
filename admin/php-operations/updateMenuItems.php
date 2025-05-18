<?php
date_default_timezone_set("Asia/Manila");
require_once("../../database.php");
session_start();

$food = $_POST['food'];

if(empty($food))
{
    header("location:../../createTodaysMenu.php");
}
else
{
    $sql1 = "DELETE FROM menu WHERE menudate=curdate()";
    $query1 = mysqli_query($connection, $sql1);

    $N = count($food);
    for($i=0; $i < $N; $i++)
    {
            $sql = "INSERT INTO menu (food_id, menudate) VALUES($food[$i], curdate())";
            $query = mysqli_query($connection, $sql);
            header("location:../viewAllMenu.php");
    }
}

?>