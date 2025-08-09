<?php
require_once '../includes/db_connect.php';
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php?error=Access Denied");
    exit();
}

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    $sql = "DELETE FROM grooming_services WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $service_id);

    if ($stmt->execute()) {
        header("Location: grooming.php?message=Grooming service deleted successfully");
    } else {
        header("Location: grooming.php?error=Error deleting service: " . $stmt->error);
    }
} else {
    header("Location: grooming.php?error=No service ID specified");
}
?>
