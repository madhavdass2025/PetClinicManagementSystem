<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

$charge_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $cost = $_POST['cost'];

    $sql = "UPDATE other_charges SET name=?, cost=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $name, $cost, $charge_id);

    if ($stmt->execute()) {
        echo "<script>alert('Charge updated successfully'); window.location.href='other_charges.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current charge data
$sql = "SELECT * FROM other_charges WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $charge_id);
$stmt->execute();
$result = $stmt->get_result();
$charge = $result->fetch_assoc();
?>

<h2>Edit Charge</h2>

<div class="card">
    <form action="other_charge_edit.php?id=<?= $charge_id ?>" method="post">
        <div class="input-group">
            <label for="name">Charge Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($charge['name']) ?>" required>
        </div>
        <div class="input-group">
            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost" value="<?= $charge['cost'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Charge</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
