<?php
$host = "localhost";
$user = "root";
$password = "diona2003";
$dbname = "ds";

// Establish database connection
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}