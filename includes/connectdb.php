<?php
$servername		= "localhost";
$username 		= "root";
$password 		= "";
$databasename 	= "oscord";

$port = 3306 ;
$conn = new mysqli($servername,$username,$password,$databasename,$port);
if ($conn->connect_error)
   die("Connection failed: " . $conn->connect_error);

$conn->set_charset("utf8mb4");

$conn->query("SET NAMES utf8mb4");
$conn->query("SET CHARACTER SET utf8mb4");
$conn->query("SET COLLATION_CONNECTION = utf8mb4_unicode_ci");
?>
