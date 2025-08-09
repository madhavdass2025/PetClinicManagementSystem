<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Manage Lab Tests</h2>

<a href="lab_test_add.php" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Add New Lab Test</a>

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
            $sql = "SELECT * FROM lab_tests ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . $row['cost'] . "</td>";
                    echo '<td>
                            <a href="lab_test_edit.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>
                            <a href="lab_test_delete.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this lab test?\')">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No lab tests found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
