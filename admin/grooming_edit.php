<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: grooming.php");
    exit();
}
$grooming_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $sql = "UPDATE grooming SET name=?, description=?, amount=? WHERE GId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $description, $amount, $grooming_id);

    if ($stmt->execute()) {
        echo "<script>alert('Grooming service updated successfully'); window.location.href='grooming.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current grooming service data
$sql = "SELECT * FROM grooming WHERE GId = ? AND cancel = '0'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $grooming_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: grooming.php?error=Service not found");
    exit();
}
$service = $result->fetch_assoc();
?>

<h2>Edit Grooming Service</h2>

<div class="card">
    <form action="grooming_edit.php?id=<?= $grooming_id ?>" method="post">
        <div class="input-group">
            <label for="name">Service Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($service['name']) ?>" required>
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4"><?= htmlspecialchars($service['description']) ?></textarea>
        </div>
        <div class="input-group">
            <label for="amount">Amount</label>
            <input type="text" id="amount" name="amount" value="<?= htmlspecialchars($service['amount']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Service</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
