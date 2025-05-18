<?php
require_once ("../../database.php");
session_start();

$upd_adminid = $_POST['upd_adminid'];
$upd_username = $_POST['upd_username'];
$upd_password = $_POST['upd_password'];
$upd_fname = $_POST['upd_fname'];
$upd_mname = $_POST['upd_mname'];
$upd_lname = $_POST['upd_lname'];


$sql = "UPDATE admin SET username='$upd_username', password='$upd_password', admin_fname ='$upd_fname', admin_mname = '$upd_mname', admin_lname = '$upd_lname' WHERE admin_id='$upd_adminid'";
$query = mysqli_query($connection, $sql);

 echo "success";
