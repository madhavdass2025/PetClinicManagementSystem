<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Admin Dashboard</h2>

<div class="card">
    <h3>Welcome to the Admin Dashboard</h3>
    <p>From here, you can manage all the master data for the clinic, including doctors, staff, medicines, and other services, based on the provided database schema.</p>
</div>

<?php
// Fetch some stats for the dashboard
$total_doctors = $conn->query("SELECT COUNT(*) as count FROM doctors WHERE cancel = '0'")->fetch_assoc()['count'];
$total_medicines = $conn->query("SELECT COUNT(*) as count FROM medicines WHERE status = 'available'")->fetch_assoc()['count'];
$total_lab_tests = $conn->query("SELECT COUNT(*) as count FROM laboratory WHERE cancel = '0'")->fetch_assoc()['count'];
?>

<div class="card-container" style="display: flex; justify-content: space-around; flex-wrap: wrap;">
    <div class="card" style="width: 30%; text-align: center;">
        <h4>Total Doctors</h4>
        <p style="font-size: 24px;"><?= $total_doctors ?></p>
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
