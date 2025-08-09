<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: other_charges.php");
    exit();
}
$charge_id = $_GET['id'];

// Soft delete the charge
$sql = "UPDATE other_charges SET status = 'inactive' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $charge_id);

if ($stmt->execute()) {
    header("Location: other_charges.php?message=Charge deleted successfully");
} else {
    header("Location: other_charges.php?error=Error deleting charge: " . $stmt->error);
}
?>
