<?php
require_once ("../../database.php");
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];

checkExist($username, $password, $fname, $mname, $lname, $connection);

function checkExist($username, $password, $fname, $mname, $lname, $connection){

  $sql = "SELECT * FROM admin WHERE username='$username'";
  $query = mysqli_query($connection, $sql);

  $exist = mysqli_num_rows($query);

  if ($exist>0) {
	  echo "failed";
  }else {
    insertData($username, $password, $fname, $mname, $lname, $connection);
  }
}
function insertData($username, $password, $fname, $mname, $lname, $connection){
  $sql = "INSERT INTO admin(username, password, admin_fname, admin_mname, admin_lname	
) VALUES ('$username', '$password', '$fname', '$mname', '$lname')";
  $query = mysqli_query($connection,$sql);
}
