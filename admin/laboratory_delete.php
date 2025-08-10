<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: laboratory.php");
    exit();
}
$lab_id = $_GET['id'];

// Soft delete the lab test
$sql = "UPDATE laboratory SET cancel = '1' WHERE Lid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $lab_id);

if ($stmt->execute()) {
    header("Location: laboratory.php?message=Lab test deleted successfully");
} else {
    header("Location: laboratory.php?error=Error deleting lab test: " . $stmt->error);
}
?>
