<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Manage Medicines</h2>

<a href="medicine_add.php" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Add New Medicine</a>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Stock Quantity</th>
                <th>Reorder Level</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM medicines ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . $row['stock_quantity'] . "</td>";
                    echo "<td>" . $row['reorder_level'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo '<td>
                            <a href="medicine_edit.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>
                            <a href="medicine_delete.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this medicine?\')">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No medicines found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
