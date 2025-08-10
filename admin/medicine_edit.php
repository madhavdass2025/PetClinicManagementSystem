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
    $status = $_POST['status'];

    $sql = "UPDATE medicines SET name=?, type=?, description=?, stock_quantity=?, reorder_level=?, UnitPrice=?, taxExcluded_price=?, taxAmount=?, hsn=?, taxable=?, Itax=?, cess=?, status=? WHERE Mid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiisssssssi", $name, $type, $description, $stock_quantity, $reorder_level, $unitPrice, $taxExcluded_price, $taxAmount, $hsn, $taxable, $itax, $cess, $status, $medicine_id);

    if ($stmt->execute()) {
        echo "<script>alert('Medicine updated successfully'); window.location.href='medicines.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current medicine data
$sql = "SELECT * FROM medicines WHERE Mid = ?";
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
            <label for="type">Type</label>
            <input type="text" id="type" name="type" value="<?= htmlspecialchars($medicine['type']) ?>">
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="<?= htmlspecialchars($medicine['description']) ?>">
        </div>
        <div class="input-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" id="stock_quantity" name="stock_quantity" value="<?= htmlspecialchars($medicine['stock_quantity']) ?>" required>
        </div>
        <div class="input-group">
            <label for="reorder_level">Reorder Level</label>
            <input type="number" id="reorder_level" name="reorder_level" value="<?= htmlspecialchars($medicine['reorder_level']) ?>" required>
        </div>
        <div class="input-group">
            <label for="hsn">HSN</label>
            <input type="text" id="hsn" name="hsn" value="<?= htmlspecialchars($medicine['hsn']) ?>" required>
        </div>
        <div class="input-group">
            <label for="unitPrice">Unit Price (MRP)</label>
            <input type="text" id="unitPrice" name="unitPrice" value="<?= htmlspecialchars($medicine['UnitPrice']) ?>" required>
        </div>
        <div class="input-group">
            <label for="taxExcluded_price">Price (Tax Excluded)</label>
            <input type="text" id="taxExcluded_price" name="taxExcluded_price" value="<?= htmlspecialchars($medicine['taxExcluded_price']) ?>" required>
        </div>
        <div class="input-group">
            <label for="taxAmount">Tax Amount</label>
            <input type="text" id="taxAmount" name="taxAmount" value="<?= htmlspecialchars($medicine['taxAmount']) ?>" required>
        </div>
        <div class="input-group">
            <label for="itax">IGST (%)</label>
            <input type="text" id="itax" name="itax" value="<?= htmlspecialchars($medicine['Itax']) ?>" required>
        </div>
        <div class="input-group">
            <label for="cess">CESS (%)</label>
            <input type="text" id="cess" name="cess" value="<?= htmlspecialchars($medicine['cess']) ?>" required>
        </div>
        <div class="input-group">
            <label for="taxable">Taxable</label>
            <select id="taxable" name="taxable">
                <option value="yes" <?= $medicine['taxable'] == 'yes' ? 'selected' : '' ?>>Yes</option>
                <option value="no" <?= $medicine['taxable'] == 'no' ? 'selected' : '' ?>>No</option>
            </select>
        </div>
        <div class="input-group">
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="available" <?= $medicine['status'] == 'available' ? 'selected' : '' ?>>Available</option>
                <option value="unavailable" <?= $medicine['status'] == 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Medicine</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
