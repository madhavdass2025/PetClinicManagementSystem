<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: doctors.php");
    exit();
}
$doctor_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorname = $_POST['doctorname'];
    $phoneno = $_POST['phoneno'];
    $status = $_POST['status'];

    $sql = "UPDATE doctors SET doctorname=?, phoneno=?, status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $doctorname, $phoneno, $status, $doctor_id);

    if ($stmt->execute()) {
        echo "<script>alert('Doctor updated successfully'); window.location.href='doctors.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current doctor data
$sql = "SELECT * FROM doctors WHERE id = ? AND cancel = '0'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: doctors.php?error=Doctor not found");
    exit();
}
$doctor = $result->fetch_assoc();
?>

<h2>Edit Doctor</h2>

<div class="card">
    <form action="doctor_edit.php?id=<?= $doctor_id ?>" method="post">
        <div class="input-group">
            <label for="doctorname">Doctor Name</label>
            <input type="text" id="doctorname" name="doctorname" value="<?= htmlspecialchars($doctor['doctorname']) ?>" required>
        </div>
        <div class="input-group">
            <label for="phoneno">Phone Number</label>
            <input type="text" id="phoneno" name="phoneno" value="<?= htmlspecialchars($doctor['phoneno']) ?>">
        </div>
        <div class="input-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="available" <?= $doctor['status'] == 'available' ? 'selected' : '' ?>>Available</option>
                <option value="unavailable" <?= $doctor['status'] == 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Doctor</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
