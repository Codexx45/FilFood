<?php

require_once("../../database.php");
session_start();

$food_id = $_POST['food_id'];
$food_name = $_POST['food_name'];
$unit_price = $_POST['unit_price'];
$category = $_POST['category'];

$sql = "SELECT food_id, food_name FROM food where food_name='$food_name' AND food_id!='$food_id'";
$query = mysqli_query($connection, $sql);

if(mysqli_fetch_assoc($query)>0){
    $_SESSION['error']="This name is already used by another food entry.";
    header("location:../editFoodForm.php?food_id=$food_id");
}else {
    if($_FILES['food_image']['size']>0){
        if ($_FILES['food_image']['type']=="image/jpeg" OR $_FILES['food_image']['type']=="image/jpg" OR $_FILES['food_image']['type']=="image/png" OR $_FILES['food_image']['type']=="image/webp") {
            $food_image=addslashes(file_get_contents($_FILES['food_image']['tmp_name']));
            $sql = "UPDATE food
            SET food_name = '$food_name',
                food_image = '$food_image',
                category = '$category',
                unit_price = '$unit_price'
            WHERE food_id='$food_id'";
            $query = mysqli_query($connection, $sql);
            $_SESSION['success']="$food_name has been updated";
            header("location:../foodAdmin.php");
        }else{
            $_SESSION['error']="The application only accepts .jpeg, .jpg, .png, and .webp files.";
            header("location:../editFoodForm.php?food_id=$food_id");
        }
    }else{
        $sql = "UPDATE food
            SET food_name = '$food_name',
                category = '$category',
                unit_price = '$unit_price'
            WHERE food_id='$food_id'";
        $query = mysqli_query($connection, $sql);
        $_SESSION['success']="$food_name has been updated";
        header("location:../foodAdmin.php");
    }
}
