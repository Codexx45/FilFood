<?php
require_once ("../../database.php");
session_start();

$adminID = $_GET['admin_id'];

$sql = "DELETE FROM admin WHERE admin_id='$adminID'";
$query = mysqli_query($connection,$sql,);

echo "success";