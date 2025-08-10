<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Manage Surgeries</h2>

<a href="surgery_add.php" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Add New Surgery</a>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM surgery WHERE cancel = '0' ORDER BY surgeryID DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['surgeryID'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['surName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['surAmount']) . "</td>";
                    echo '<td>
                            <a href="surgery_edit.php?id=' . $row['surgeryID'] . '" class="btn btn-primary">Edit</a>
                            <a href="surgery_delete.php?id=' . $row['surgeryID'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this surgery?\')">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No active surgeries found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
