<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: grooming.php");
    exit();
}
$grooming_id = $_GET['id'];

// Soft delete the service
$sql = "UPDATE grooming SET cancel = '1' WHERE GId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $grooming_id);

if ($stmt->execute()) {
    header("Location: grooming.php?message=Service deleted successfully");
} else {
    header("Location: grooming.php?error=Error deleting service: " . $stmt->error);
}
?>
