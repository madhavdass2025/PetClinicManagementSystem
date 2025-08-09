<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: lab_tests.php");
    exit();
}
$test_id = $_GET['id'];

// Soft delete the lab test
$sql = "UPDATE lab_tests SET status = 'inactive' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $test_id);

if ($stmt->execute()) {
    header("Location: lab_tests.php?message=Lab test deleted successfully");
} else {
    header("Location: lab_tests.php?error=Error deleting lab test: " . $stmt->error);
}
?>
