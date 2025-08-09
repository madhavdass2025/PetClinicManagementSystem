<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_clinic";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to utf8
$conn->set_charset("utf8");
?>
