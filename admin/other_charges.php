<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Manage Other Charges</h2>

<a href="other_charge_add.php" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Add New Charge</a>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM other_charges WHERE cancel = '0' ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cost']) . "</td>";
                    echo '<td>
                            <a href="other_charge_edit.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>
                            <a href="other_charge_delete.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this charge?\')">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No active charges found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
