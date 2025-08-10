<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jeoczvkk_thecochinpetshop"; // Updated database name from the user's dump

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to utf8
$conn->set_charset("utf8mb4");
?>
