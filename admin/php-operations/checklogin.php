<?php

  require_once("../../database.php");
  session_start();
   $username= $_POST['username'];
   $password= $_POST['password'];



   $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password' ";
   $query = mysqli_query($connection, $sql);

   $exist = mysqli_num_rows($query);

   if($exist>0) {

     echo "success";

   }else{
     echo "invalid";
   }

 ?>
