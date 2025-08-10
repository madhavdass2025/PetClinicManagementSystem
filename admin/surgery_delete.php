<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: surgery.php");
    exit();
}
$surgery_id = $_GET['id'];

// Soft delete the surgery
$sql = "UPDATE surgery SET cancel = '1' WHERE surgeryID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $surgery_id);

if ($stmt->execute()) {
    header("Location: surgery.php?message=Surgery deleted successfully");
} else {
    header("Location: surgery.php?error=Error deleting surgery: " . $stmt->error);
}
?>
