<?php
require_once '../includes/db_connect.php';
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php?error=Access Denied");
    exit();
}

if (isset($_GET['id'])) {
    $medicine_id = $_GET['id'];

    $sql = "DELETE FROM medicines WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medicine_id);

    if ($stmt->execute()) {
        header("Location: medicines.php?message=Medicine deleted successfully");
    } else {
        header("Location: medicines.php?error=Error deleting medicine: " . $stmt->error);
    }
} else {
    header("Location: medicines.php?error=No medicine ID specified");
}
?>
