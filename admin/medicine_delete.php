<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: medicines.php");
    exit();
}
$medicine_id = $_GET['id'];

// Soft delete the medicine by updating its status to 'unavailable'
$sql = "UPDATE medicines SET status = 'unavailable' WHERE Mid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $medicine_id);

if ($stmt->execute()) {
    header("Location: medicines.php?message=Medicine deleted successfully");
} else {
    header("Location: medicines.php?error=Error deleting medicine: " . $stmt->error);
}
?>
