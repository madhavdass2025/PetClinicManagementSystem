<?php
require_once '../includes/db_connect.php';
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php?error=Access Denied");
    exit();
}

if (isset($_GET['id'])) {
    $test_id = $_GET['id'];

    $sql = "DELETE FROM lab_tests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $test_id);

    if ($stmt->execute()) {
        header("Location: lab_tests.php?message=Lab test deleted successfully");
    } else {
        header("Location: lab_tests.php?error=Error deleting lab test: " . $stmt->error);
    }
} else {
    header("Location: lab_tests.php?error=No lab test ID specified");
}
?>
