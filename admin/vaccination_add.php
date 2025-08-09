<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $details = $_POST['details'];
    $cost = $_POST['cost'];

    $sql = "INSERT INTO vaccinations (name, details, cost) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $name, $details, $cost);

    if ($stmt->execute()) {
        echo "<script>alert('New vaccination added successfully'); window.location.href='vaccinations.php';</script>";
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
            <label for="details">Details</label>
            <textarea id="details" name="details" rows="4"></textarea>
        </div>
        <div class="input-group">
            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost" required pattern="[0-9]+(\.[0-9]{1,2})?" title="Please enter a valid price">
        </div>
        <button type="submit" class="btn btn-success">Add Vaccination</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
