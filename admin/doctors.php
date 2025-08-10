<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';
?>

<h2>Manage Doctors</h2>

<a href="doctor_add.php" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Add New Doctor</a>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone No</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Only select active doctors
            $sql = "SELECT * FROM doctors WHERE cancel = '0' ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['doctorname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phoneno']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo '<td>
                            <a href="doctor_edit.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>
                            <a href="doctor_delete.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this doctor?\')">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No active doctors found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
