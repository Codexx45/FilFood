<?php
date_default_timezone_set("Asia/Manila");
require_once("../../database.php");
session_start();

$food = $_POST['food'];

echo $menu_date;

if(empty($food))
{
    header("location:../../viewAllMenu.php");
}
else
{
    $N = count($food);
    for($i=0; $i < $N; $i++)
    {
        $sql = "SELECT food_id, menudate FROM menu WHERE food_id=$food[$i] AND menudate=curdate()";
        $query = mysqli_query($connection, $sql);
        $exist = mysqli_num_rows($query);

        if($exist>0){
            continue;
        }
        else{
            $sql = "INSERT INTO menu (food_id, menudate) VALUES($food[$i], curdate())";
            $query = mysqli_query($connection, $sql);
            header("location:../viewAllMenu.php");
        }
    }
}
?>