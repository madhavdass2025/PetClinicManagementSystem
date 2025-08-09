<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: lab_tests.php");
    exit();
}
$test_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];

    $sql = "UPDATE lab_tests SET name=?, description=?, cost=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $name, $description, $cost, $test_id);

    if ($stmt->execute()) {
        echo "<script>alert('Lab test updated successfully'); window.location.href='lab_tests.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current lab test data
$sql = "SELECT * FROM lab_tests WHERE id = ? AND status = 'active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $test_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: lab_tests.php?error=Lab test not found");
    exit();
}
$test = $result->fetch_assoc();
?>

<h2>Edit Lab Test</h2>

<div class="card">
    <form action="lab_test_edit.php?id=<?= $test_id ?>" method="post">
        <div class="input-group">
            <label for="name">Test Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($test['name']) ?>" required>
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4"><?= htmlspecialchars($test['description']) ?></textarea>
        </div>
        <div class="input-group">
            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost" value="<?= $test['cost'] ?>" required pattern="[0-9]+(\.[0-9]{1,2})?" title="Please enter a valid price">
        </div>
        <button type="submit" class="btn btn-primary">Update Lab Test</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
