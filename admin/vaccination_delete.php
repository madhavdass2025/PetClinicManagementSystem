<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: vaccination.php");
    exit();
}
$vaccination_id = $_GET['id'];

// Soft delete the vaccination
$sql = "UPDATE vaccination SET cancel = '1' WHERE VId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vaccination_id);

if ($stmt->execute()) {
    header("Location: vaccination.php?message=Vaccination deleted successfully");
} else {
    header("Location: vaccination.php?error=Error deleting vaccination: " . $stmt->error);
}
?>
