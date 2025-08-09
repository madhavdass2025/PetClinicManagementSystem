<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];

    $sql = "INSERT INTO grooming_services (name, description, cost) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $name, $description, $cost);

    if ($stmt->execute()) {
        echo "<script>alert('New grooming service added successfully'); window.location.href='grooming.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Add New Grooming Service</h2>

<div class="card">
    <form action="grooming_add.php" method="post">
        <div class="input-group">
            <label for="name">Service Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4"></textarea>
        </div>
        <div class="input-group">
            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost" required pattern="[0-9]+(\.[0-9]{1,2})?" title="Please enter a valid price">
        </div>
        <button type="submit" class="btn btn-success">Add Service</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
