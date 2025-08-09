<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

$vaccination_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $details = $_POST['details'];
    $cost = $_POST['cost'];

    $sql = "UPDATE vaccinations SET name=?, details=?, cost=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $name, $details, $cost, $vaccination_id);

    if ($stmt->execute()) {
        echo "<script>alert('Vaccination updated successfully'); window.location.href='vaccinations.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current vaccination data
$sql = "SELECT * FROM vaccinations WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vaccination_id);
$stmt->execute();
$result = $stmt->get_result();
$vaccination = $result->fetch_assoc();
?>

<h2>Edit Vaccination</h2>

<div class="card">
    <form action="vaccination_edit.php?id=<?= $vaccination_id ?>" method="post">
        <div class="input-group">
            <label for="name">Vaccination Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($vaccination['name']) ?>" required>
        </div>
        <div class="input-group">
            <label for="details">Details</label>
            <textarea id="details" name="details" rows="4" style="width: 100%;"><?= htmlspecialchars($vaccination['details']) ?></textarea>
        </div>
        <div class="input-group">
            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost" value="<?= $vaccination['cost'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Vaccination</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
