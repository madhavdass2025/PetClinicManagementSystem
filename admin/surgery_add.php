<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surName = $_POST['surName'];
    $surAmount = $_POST['surAmount'];
    $submitBy = $_SESSION['username'];

    $sql = "INSERT INTO surgery (surName, surAmount, submitBy) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $surName, $surAmount, $submitBy);

    if ($stmt->execute()) {
        echo "<script>alert('New surgery added successfully'); window.location.href='surgery.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Add New Surgery</h2>

<div class="card">
    <form action="surgery_add.php" method="post">
        <div class="input-group">
            <label for="surName">Surgery Name</label>
            <input type="text" id="surName" name="surName" required>
        </div>
        <div class="input-group">
            <label for="surAmount">Amount</label>
            <input type="text" id="surAmount" name="surAmount" required>
        </div>
        <button type="submit" class="btn btn-success">Add Surgery</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
