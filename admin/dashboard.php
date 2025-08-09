<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Admin Dashboard</h2>

<div class="card">
    <h3>Welcome to the Admin Dashboard</h3>
    <p>From here, you can manage all the master data for the clinic, including medicines, lab tests, staff, and more. Use the navigation on the left to get started.</p>
</div>

<?php
// Fetch some stats for the dashboard
$total_staff = $conn->query("SELECT COUNT(*) as count FROM staff WHERE status = 'active'")->fetch_assoc()['count'];
$total_medicines = $conn->query("SELECT COUNT(*) as count FROM medicines WHERE status = 'active'")->fetch_assoc()['count'];
$total_lab_tests = $conn->query("SELECT COUNT(*) as count FROM lab_tests WHERE status = 'active'")->fetch_assoc()['count'];
?>

<div class="card-container" style="display: flex; justify-content: space-around; flex-wrap: wrap;">
    <div class="card" style="width: 30%; text-align: center;">
        <h4>Total Staff</h4>
        <p style="font-size: 24px;"><?= $total_staff ?></p>
    </div>
    <div class="card" style="width: 30%; text-align: center;">
        <h4>Total Medicines</h4>
        <p style="font-size: 24px;"><?= $total_medicines ?></p>
    </div>
    <div class="card" style="width: 30%; text-align: center;">
        <h4>Total Lab Tests</h4>
        <p style="font-size: 24px;"><?= $total_lab_tests ?></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
