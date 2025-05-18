<?php

require_once("../../database.php");
session_start();

$food_name = $_POST['food_name'];
$unit_price = $_POST['unit_price'];
$category = $_POST['category'];

//checks if food entry with same name already exists
$sql = "SELECT * FROM food WHERE food_name='$food_name'";
$query = mysqli_query($connection, $sql);

if(mysqli_fetch_assoc($query)==0){
    if($_FILES['food_image']['size']>0 AND ($_FILES['food_image']['type']=="image/jpeg" OR $_FILES['food_image']['type']=="image/jpg" OR $_FILES['food_image']['type']=="image/png" OR $_FILES['food_image']['type']=="image/webp")){
        $food_image=addslashes(file_get_contents($_FILES['food_image']['tmp_name']));
        $sql1 = "INSERT INTO food (food_name, food_image, category, unit_price)
            values ('$food_name',
	                '$food_image',
	                '$category',
                     '$unit_price')";
        $query1 = mysqli_query($connection, $sql1);
        $_SESSION['success'] = "New entry for $food_name has been added!";
        header("location:../foodAdmin.php");
    }else{
        echo $_FILES['food_image']['type'];
        $_SESSION['error']="The application only accepts .jpeg, .jpg, .png, and .webp files.";
        header("location:../newFoodForm.php");
    }
}else{
    $_SESSION['error']="This name is already used by another food entry.";
    header("location:../newFoodForm.php");
}

?>
