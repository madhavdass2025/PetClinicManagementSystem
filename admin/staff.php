<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Manage Staff</h2>

<a href="staff_add.php" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Add New Staff Member</a>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM staff WHERE status = 'active' ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                    echo '<td>
                            <a href="staff_edit.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>
                            <a href="staff_delete.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this staff member? Their login account will be disabled.\')">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No active staff members found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
