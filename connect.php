<?php 
// Connect to your database (example using MySQLi)
$host = "localhost";
$username = "root";
$password = "";
$database = "salon2";

//$conn = new mysqli($host, $username, $password, $database); it is the same
$conn = mysqli_connect($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>