<?php

// MySQL database connection
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "ds";

$conn = mysqli_connect($host, $user, $pass, $db_name);

if(mysqli_connect_errno()){
   die("Failed to connect with MySQL: ".mysqli_connect_error());
}

?>
