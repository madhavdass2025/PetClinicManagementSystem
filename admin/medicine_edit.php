<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: medicines.php");
    exit();
}
$medicine_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $stock_quantity = $_POST['stock_quantity'];
    $reorder_level = $_POST['reorder_level'];
    $price = $_POST['price'];

    $sql = "UPDATE medicines SET name=?, description=?, stock_quantity=?, reorder_level=?, price=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiidi", $name, $description, $stock_quantity, $reorder_level, $price, $medicine_id);

    if ($stmt->execute()) {
        echo "<script>alert('Medicine updated successfully'); window.location.href='medicines.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current medicine data
$sql = "SELECT * FROM medicines WHERE id = ? AND status = 'active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $medicine_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: medicines.php?error=Medicine not found");
    exit();
}
$medicine = $result->fetch_assoc();
?>

<h2>Edit Medicine</h2>

<div class="card">
    <form action="medicine_edit.php?id=<?= $medicine_id ?>" method="post">
        <div class="input-group">
            <label for="name">Medicine Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($medicine['name']) ?>" required>
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4"><?= htmlspecialchars($medicine['description']) ?></textarea>
        </div>
        <div class="input-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" id="stock_quantity" name="stock_quantity" value="<?= $medicine['stock_quantity'] ?>" required>
        </div>
        <div class="input-group">
            <label for="reorder_level">Reorder Level</label>
            <input type="number" id="reorder_level" name="reorder_level" value="<?= $medicine['reorder_level'] ?>" required>
        </div>
        <div class="input-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" value="<?= $medicine['price'] ?>" required pattern="[0-9]+(\.[0-9]{1,2})?" title="Please enter a valid price">
        </div>
        <button type="submit" class="btn btn-primary">Update Medicine</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
