<?php
$servername = "mariadb";
$username = "cs332u7";
$password = "hnSfRXu6";
$dbname = "cs332u7";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>