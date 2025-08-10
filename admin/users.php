<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Manage Users</h2>

<a href="user_add.php" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Add New User</a>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Only select active users
            $sql = "SELECT * FROM admin_user WHERE cancel = '0' ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                    echo '<td>
                            <a href="user_edit.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>
                            <a href="user_delete.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No active users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
