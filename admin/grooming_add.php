<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $submittedBy = $_SESSION['username'];

    $sql = "INSERT INTO grooming (name, description, amount, submittedBy) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $description, $amount, $submittedBy);

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
            <label for="amount">Amount</label>
            <input type="text" id="amount" name="amount" required>
        </div>
        <button type="submit" class="btn btn-success">Add Service</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
