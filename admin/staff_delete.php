<?php
require_once '../includes/db_connect.php';
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php?error=Access Denied");
    exit();
}

if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];

    $conn->begin_transaction();

    try {
        // First, delete the user account
        $sql_user = "DELETE FROM users WHERE staff_id = ?";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param("i", $staff_id);
        if (!$stmt_user->execute()) {
            // If the user doesn't exist, that's okay. But if there's another error, throw it.
            if ($stmt_user->errno) {
                 throw new Exception("Error deleting user account: " . $stmt_user->error);
            }
        }

        // Then, delete the staff member
        $sql_staff = "DELETE FROM staff WHERE id = ?";
        $stmt_staff = $conn->prepare($sql_staff);
        $stmt_staff->bind_param("i", $staff_id);
        if (!$stmt_staff->execute()) {
            throw new Exception("Error deleting staff member: " . $stmt_staff->error);
        }

        $conn->commit();
        header("Location: staff.php?message=Staff member deleted successfully");

    } catch (Exception $e) {
        $conn->rollback();
        header("Location: staff.php?error=" . urlencode($e->getMessage()));
    }

} else {
    header("Location: staff.php?error=No staff ID specified");
}
?>
