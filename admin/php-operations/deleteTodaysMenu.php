<?php
date_default_timezone_set("Asia/Manila");
require_once("../../database.php");
session_start();

$sql1 = "DELETE FROM menu WHERE menudate=curdate()";
$query1 = mysqli_query($connection, $sql1);
header("location:../viewAllMenu.php");

?>