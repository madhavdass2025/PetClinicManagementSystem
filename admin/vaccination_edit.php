<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: vaccination.php");
    exit();
}
$vaccination_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $duration = $_POST['duration'];

    $sql = "UPDATE vaccination SET name=?, amount=?, type=?, duration=? WHERE VId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $amount, $type, $duration, $vaccination_id);

    if ($stmt->execute()) {
        echo "<script>alert('Vaccination updated successfully'); window.location.href='vaccination.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current vaccination data
$sql = "SELECT * FROM vaccination WHERE VId = ? AND cancel = '0'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vaccination_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: vaccination.php?error=Vaccination not found");
    exit();
}
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
            <label for="amount">Amount</label>
            <input type="text" id="amount" name="amount" value="<?= htmlspecialchars($vaccination['amount']) ?>" required>
        </div>
        <div class="input-group">
            <label for="type">Type (e.g., DOG, CAT)</label>
            <input type="text" id="type" name="type" value="<?= htmlspecialchars($vaccination['type']) ?>">
        </div>
        <div class="input-group">
            <label for="duration">Duration (in days)</label>
            <input type="text" id="duration" name="duration" value="<?= htmlspecialchars($vaccination['duration']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Vaccination</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
