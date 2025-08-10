<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $duration = $_POST['duration'];
    $submittedBy = $_SESSION['username'];

    $sql = "INSERT INTO vaccination (name, amount, type, duration, submittedBy) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $amount, $type, $duration, $submittedBy);

    if ($stmt->execute()) {
        echo "<script>alert('New vaccination added successfully'); window.location.href='vaccination.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Add New Vaccination</h2>

<div class="card">
    <form action="vaccination_add.php" method="post">
        <div class="input-group">
            <label for="name">Vaccination Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="amount">Amount</label>
            <input type="text" id="amount" name="amount" required>
        </div>
        <div class="input-group">
            <label for="type">Type (e.g., DOG, CAT)</label>
            <input type="text" id="type" name="type">
        </div>
        <div class="input-group">
            <label for="duration">Duration (in days)</label>
            <input type="text" id="duration" name="duration" required>
        </div>
        <button type="submit" class="btn btn-success">Add Vaccination</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
