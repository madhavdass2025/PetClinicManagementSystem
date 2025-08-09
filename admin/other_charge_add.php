<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $cost = $_POST['cost'];

    $sql = "INSERT INTO other_charges (name, cost) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sd", $name, $cost);

    if ($stmt->execute()) {
        echo "<script>alert('New charge added successfully'); window.location.href='other_charges.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Add New Charge</h2>

<div class="card">
    <form action="other_charge_add.php" method="post">
        <div class="input-group">
            <label for="name">Charge Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost" required>
        </div>
        <button type="submit" class="btn btn-success">Add Charge</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
