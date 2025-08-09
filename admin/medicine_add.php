<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $stock_quantity = $_POST['stock_quantity'];
    $reorder_level = $_POST['reorder_level'];
    $price = $_POST['price'];

    $sql = "INSERT INTO medicines (name, description, stock_quantity, reorder_level, price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiid", $name, $description, $stock_quantity, $reorder_level, $price);

    if ($stmt->execute()) {
        echo "<script>alert('New medicine added successfully'); window.location.href='medicines.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Add New Medicine</h2>

<div class="card">
    <form action="medicine_add.php" method="post">
        <div class="input-group">
            <label for="name">Medicine Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4"></textarea>
        </div>
        <div class="input-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" id="stock_quantity" name="stock_quantity" required>
        </div>
        <div class="input-group">
            <label for="reorder_level">Reorder Level</label>
            <input type="number" id="reorder_level" name="reorder_level" required>
        </div>
        <div class="input-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" required pattern="[0-9]+(\.[0-9]{1,2})?" title="Please enter a valid price">
        </div>
        <button type="submit" class="btn btn-success">Add Medicine</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
