<?php
require_once '../includes/db_connect.php';
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php?error=Access Denied");
    exit();
}

if (isset($_GET['id'])) {
    $vaccination_id = $_GET['id'];

    $sql = "DELETE FROM vaccinations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vaccination_id);

    if ($stmt->execute()) {
        header("Location: vaccinations.php?message=Vaccination deleted successfully");
    } else {
        header("Location: vaccinations.php?error=Error deleting vaccination: " . $stmt->error);
    }
} else {
    header("Location: vaccinations.php?error=No vaccination ID specified");
}
?>
