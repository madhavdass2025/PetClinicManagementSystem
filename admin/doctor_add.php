<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorname = $_POST['doctorname'];
    $phoneno = $_POST['phoneno'];
    $status = $_POST['status'];

    $sql = "INSERT INTO doctors (doctorname, phoneno, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $doctorname, $phoneno, $status);

    if ($stmt->execute()) {
        echo "<script>alert('New doctor added successfully'); window.location.href='doctors.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Add New Doctor</h2>

<div class="card">
    <form action="doctor_add.php" method="post">
        <div class="input-group">
            <label for="doctorname">Doctor Name</label>
            <input type="text" id="doctorname" name="doctorname" required>
        </div>
        <div class="input-group">
            <label for="phoneno">Phone Number</label>
            <input type="text" id="phoneno" name="phoneno">
        </div>
        <div class="input-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add Doctor</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
