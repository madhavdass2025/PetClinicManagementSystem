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
            <li><a href="users.php" class="<?= $current_page == 'users.php' ? 'active' : '' ?>">Users</a></li>
            <li><a href="doctors.php" class="<?= $current_page == 'doctors.php' ? 'active' : '' ?>">Doctors</a></li>
            <li><a href="medicines.php" class="<?= $current_page == 'medicines.php' ? 'active' : '' ?>">Medicines</a></li>
            <li><a href="laboratory.php" class="<?= $current_page == 'laboratory.php' ? 'active' : '' ?>">Lab Tests</a></li>
            <li><a href="grooming.php" class="<?= $current_page == 'grooming.php' ? 'active' : '' ?>">Grooming</a></li>
            <li><a href="vaccination.php" class="<?= $current_page == 'vaccination.php' ? 'active' : '' ?>">Vaccination</a></li>
            <li><a href="surgery.php" class="<?= $current_page == 'surgery.php' ? 'active' : '' ?>">Surgery</a></li>
            <li><a href="other_charges.php" class="<?= $current_page == 'other_charges.php' ? 'active' : '' ?>">Other Charges</a></li>
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
