<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: laboratory.php");
    exit();
}
$lab_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $sql = "UPDATE laboratory SET name=?, description=?, amount=? WHERE Lid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $description, $amount, $lab_id);

    if ($stmt->execute()) {
        echo "<script>alert('Lab test updated successfully'); window.location.href='laboratory.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current lab test data
$sql = "SELECT * FROM laboratory WHERE Lid = ? AND cancel = '0'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $lab_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: laboratory.php?error=Lab test not found");
    exit();
}
$lab_test = $result->fetch_assoc();
?>

<h2>Edit Lab Test</h2>

<div class="card">
    <form action="laboratory_edit.php?id=<?= $lab_id ?>" method="post">
        <div class="input-group">
            <label for="name">Test Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($lab_test['name']) ?>" required>
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4"><?= htmlspecialchars($lab_test['description']) ?></textarea>
        </div>
        <div class="input-group">
            <label for="amount">Amount</label>
            <input type="text" id="amount" name="amount" value="<?= htmlspecialchars($lab_test['amount']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Lab Test</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
