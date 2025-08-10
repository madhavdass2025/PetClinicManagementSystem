<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Note: The schema uses varchar for numeric fields. We should handle this carefully.
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $stock_quantity = $_POST['stock_quantity'];
    $reorder_level = $_POST['reorder_level'];
    $unitPrice = $_POST['unitPrice'];
    $taxExcluded_price = $_POST['taxExcluded_price'];
    $taxAmount = $_POST['taxAmount'];
    $hsn = $_POST['hsn'];
    $taxable = $_POST['taxable'];
    $itax = $_POST['itax'];
    $cess = $_POST['cess'];
    $submittedby = $_SESSION['username']; // Assuming the logged in admin is the submitter

    $sql = "INSERT INTO medicines (name, type, description, stock_quantity, reorder_level, UnitPrice, taxExcluded_price, taxAmount, hsn, taxable, Itax, cess, submittedby) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    // All columns are varchar in the provided schema, so we use 's' for all, except for the new integer fields.
    $stmt->bind_param("sssiissssssss", $name, $type, $description, $stock_quantity, $reorder_level, $unitPrice, $taxExcluded_price, $taxAmount, $hsn, $taxable, $itax, $cess, $submittedby);

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
            <label for="type">Type</label>
            <input type="text" id="type" name="type">
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description">
        </div>
        <div class="input-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" id="stock_quantity" name="stock_quantity" value="0" required>
        </div>
        <div class="input-group">
            <label for="reorder_level">Reorder Level</label>
            <input type="number" id="reorder_level" name="reorder_level" value="10" required>
        </div>
        <div class="input-group">
            <label for="hsn">HSN</label>
            <input type="text" id="hsn" name="hsn" required>
        </div>
        <div class="input-group">
            <label for="unitPrice">Unit Price (MRP)</label>
            <input type="text" id="unitPrice" name="unitPrice" required>
        </div>
        <div class="input-group">
            <label for="taxExcluded_price">Price (Tax Excluded)</label>
            <input type="text" id="taxExcluded_price" name="taxExcluded_price" required>
        </div>
        <div class="input-group">
            <label for="taxAmount">Tax Amount</label>
            <input type="text" id="taxAmount" name="taxAmount" required>
        </div>
        <div class="input-group">
            <label for="itax">IGST (%)</label>
            <input type="text" id="itax" name="itax" required>
        </div>
        <div class="input-group">
            <label for="cess">CESS (%)</label>
            <input type="text" id="cess" name="cess" required>
        </div>
        <div class="input-group">
            <label for="taxable">Taxable</label>
            <select id="taxable" name="taxable">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add Medicine</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
