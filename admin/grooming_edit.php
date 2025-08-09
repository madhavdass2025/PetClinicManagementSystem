<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

$service_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];

    $sql = "UPDATE grooming_services SET name=?, description=?, cost=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $name, $description, $cost, $service_id);

    if ($stmt->execute()) {
        echo "<script>alert('Grooming service updated successfully'); window.location.href='grooming.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current grooming service data
$sql = "SELECT * FROM grooming_services WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();
$service = $result->fetch_assoc();
?>

<h2>Edit Grooming Service</h2>

<div class="card">
    <form action="grooming_edit.php?id=<?= $service_id ?>" method="post">
        <div class="input-group">
            <label for="name">Service Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($service['name']) ?>" required>
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" style="width: 100%;"><?= htmlspecialchars($service['description']) ?></textarea>
        </div>
        <div class="input-group">
            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost" value="<?= $service['cost'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Service</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
