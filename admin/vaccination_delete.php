<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: vaccinations.php");
    exit();
}
$vaccination_id = $_GET['id'];

// Soft delete the vaccination
$sql = "UPDATE vaccinations SET status = 'inactive' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vaccination_id);

if ($stmt->execute()) {
    header("Location: vaccinations.php?message=Vaccination deleted successfully");
} else {
    header("Location: vaccinations.php?error=Error deleting vaccination: " . $stmt->error);
}
?>
