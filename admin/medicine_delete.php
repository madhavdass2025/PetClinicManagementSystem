<?php
require_once '../includes/db_connect.php';
include 'includes/header.php'; // To use session check

if (!isset($_GET['id'])) {
    header("Location: medicines.php");
    exit();
}
$medicine_id = $_GET['id'];

// Soft delete the medicine by updating its status to 'inactive'
$sql = "UPDATE medicines SET status = 'inactive' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $medicine_id);

if ($stmt->execute()) {
    header("Location: medicines.php?message=Medicine deleted successfully");
} else {
    header("Location: medicines.php?error=Error deleting medicine: " . $stmt->error);
}
?>
