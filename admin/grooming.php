<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Manage Grooming Services</h2>

<a href="grooming_add.php" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Add New Grooming Service</a>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM grooming_services WHERE status = 'active' ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . number_format($row['cost'], 2) . "</td>";
                    echo '<td>
                            <a href="grooming_edit.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>
                            <a href="grooming_delete.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this service?\')">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No active grooming services found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
