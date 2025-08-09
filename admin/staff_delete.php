<?php
require_once '../includes/db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: staff.php");
    exit();
}
$staff_id = $_GET['id'];

$conn->begin_transaction();

try {
    // Soft delete the user account first
    $sql_user = "UPDATE users SET status = 'inactive' WHERE staff_id = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("i", $staff_id);
    if (!$stmt_user->execute()) {
        throw new Exception("Error disabling user account: " . $stmt_user->error);
    }

    // Then, soft delete the staff member
    $sql_staff = "UPDATE staff SET status = 'inactive' WHERE id = ?";
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
?>
