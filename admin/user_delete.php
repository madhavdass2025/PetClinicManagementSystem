<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}
$user_id = $_GET['id'];

// Soft delete the user
$sql = "UPDATE admin_user SET cancel = '1' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    header("Location: users.php?message=User deleted successfully");
} else {
    header("Location: users.php?error=Error deleting user: " . $stmt->error);
}
?>
