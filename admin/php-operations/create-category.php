<?php
require_once("../../database.php");
session_start();

$category = $_POST['category'];
$image = $_FILES['image'];
//Check whether the image is selected or not and set the value for image name accoridingly
//print_r($_FILES['image']);

//For Radio input, we need to check whether the button is selected or not
if(isset($_POST['active'])){
	$active = $_POST['active'];
}else{
	$active = "No";
}

$imageName = $_FILES['image']['name'];
$imageTmpName = $_FILES['image']['tmp_name'];
$imageSize = $_FILES['image']['size'];
$imageError = $_FILES['image']['error'];
$imageType = $_FILES['image']['type'];

$imageExt = explode('.', $imageName);
$imageActualExt = strtolower(end($imageExt));

$allowed = array('jpg', 'jpeg', 'png');

if(in_array($imageActualExt, $allowed)){
	if($imageError === 0){
		if($imageSize < 1000000){
			$imageNameNew = "Food-Category-".rand(0000,9999). "." . $imageActualExt;
			$imageDestination = '../../uploads/categoryimg/' . $imageNameNew;
			move_uploaded_file($imageTmpName, $imageDestination);
		}else{
			$_SESSION['error'] =  "The file too large!";
			header("location: ../add_category.php");
		}
	}else{
		$_SESSION['error'] = "There was an error uploading youe file";
		header("location: ../add_category.php");
	}
}else{
	$_SESSION['error'] =  "You cannot upload files of this type!";
	header("location: ../add_category.php");
}


$sql = "SELECT * FROM categoriestbl WHERE category='$category'";
$query = mysqli_query($connection, $sql);

$exist = mysqli_num_rows($query);

if ($exist>0) {
	$_SESSION['error'] = "The category: " . $category . " already exists!";
    header("location: ../add_category.php");
}else {
	insertData($category, $imageNameNew, $active, $connection);
	$_SESSION['error'] = "";
    unset($_SESSION['error']);
	header("location: ../admin_category.php");
}


function insertData($category, $imageNameNew, $active, $connection){
 $sql = "INSERT INTO categoriestbl(category, img, active) VALUES ('$category', '$imageNameNew', '$active')";
 $query = mysqli_query($connection,$sql);
}

	