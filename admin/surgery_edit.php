<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: surgery.php");
    exit();
}
$surgery_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surName = $_POST['surName'];
    $surAmount = $_POST['surAmount'];

    $sql = "UPDATE surgery SET surName=?, surAmount=? WHERE surgeryID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $surName, $surAmount, $surgery_id);

    if ($stmt->execute()) {
        echo "<script>alert('Surgery updated successfully'); window.location.href='surgery.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current surgery data
$sql = "SELECT * FROM surgery WHERE surgeryID = ? AND cancel = '0'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $surgery_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: surgery.php?error=Surgery not found");
    exit();
}
$surgery = $result->fetch_assoc();
?>

<h2>Edit Surgery</h2>

<div class="card">
    <form action="surgery_edit.php?id=<?= $surgery_id ?>" method="post">
        <div class="input-group">
            <label for="surName">Surgery Name</label>
            <input type="text" id="surName" name="surName" value="<?= htmlspecialchars($surgery['surName']) ?>" required>
        </div>
        <div class="input-group">
            <label for="surAmount">Amount</label>
            <input type="text" id="surAmount" name="surAmount" value="<?= htmlspecialchars($surgery['surAmount']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Surgery</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
