<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "silapor";

$conn = mysqli_connect($host, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>