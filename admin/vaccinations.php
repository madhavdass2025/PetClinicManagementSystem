<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Manage Vaccinations</h2>

<a href="vaccination_add.php" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Add New Vaccination</a>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Details</th>
                <th>Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM vaccinations ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['details']) . "</td>";
                    echo "<td>" . $row['cost'] . "</td>";
                    echo '<td>
                            <a href="vaccination_edit.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>
                            <a href="vaccination_delete.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this vaccination?\')">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No vaccinations found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
