<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: doctors.php");
    exit();
}
$doctor_id = $_GET['id'];

// Soft delete the doctor by updating the cancel column to '1'
$sql = "UPDATE doctors SET cancel = '1' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);

if ($stmt->execute()) {
    header("Location: doctors.php?message=Doctor deleted successfully");
} else {
    header("Location: doctors.php?error=Error deleting doctor: " . $stmt->error);
}
?>
