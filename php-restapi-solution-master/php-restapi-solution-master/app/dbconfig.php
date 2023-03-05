<?php
$servername = "mysql";
$username = "root";
$password = "secret123";
$database = "thefestivaldb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

