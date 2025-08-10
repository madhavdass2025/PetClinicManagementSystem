<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Manage Laboratory Tests</h2>

<a href="laboratory_add.php" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Add New Lab Test</a>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM laboratory WHERE cancel = '0' ORDER BY Lid DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Lid'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                    echo '<td>
                            <a href="laboratory_edit.php?id=' . $row['Lid'] . '" class="btn btn-primary">Edit</a>
                            <a href="laboratory_delete.php?id=' . $row['Lid'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this lab test?\')">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No active lab tests found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
