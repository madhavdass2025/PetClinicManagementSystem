<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php?error=Access Denied");
    exit();
}

// Get the current page name to set the active class on the navigation link
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pet Clinic</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <ul>
            <li><a href="dashboard.php" class="<?= $current_page == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="medicines.php" class="<?= $current_page == 'medicines.php' ? 'active' : '' ?>">Medicines</a></li>
            <li><a href="lab_tests.php" class="<?= $current_page == 'lab_tests.php' ? 'active' : '' ?>">Lab Tests</a></li>
            <li><a href="grooming.php" class="<?= $current_page == 'grooming.php' ? 'active' : '' ?>">Grooming</a></li>
            <li><a href="vaccinations.php" class="<?= $current_page == 'vaccinations.php' ? 'active' : '' ?>">Vaccinations</a></li>
            <li><a href="other_charges.php" class="<?= $current_page == 'other_charges.php' ? 'active' : '' ?>">Other Charges</a></li>
            <li><a href="staff.php" class="<?= $current_page == 'staff.php' ? 'active' : '' ?>">Staff</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <div class="user-info">
                Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
            </div>
            <div class="logout">
                <a href="../logout.php">Logout</a>
            </div>
        </div>
        <div class="content" style="padding-top: 20px;">
