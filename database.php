<?php

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "filfood";

$connection = mysqli_connect($servername, $username, $password, $databasename);

if(!$connection)
    die("Can't connect" . mysqli_connect_error());

//This enables the user to upload large images
$sql1 = "SELECT @@max_allowed_packet";
$query = mysqli_query($connection, $sql1);
$sql2 = "SET GLOBAL max_allowed_packet=1000000000";
$query2 = mysqli_query($connection, $sql2);

?>