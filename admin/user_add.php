<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    $sql = "INSERT INTO admin_user (username, password, type) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $type);

    if ($stmt->execute()) {
        echo "<script>alert('New user added successfully'); window.location.href='users.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Add New User</h2>

<div class="card">
    <form action="user_add.php" method="post">
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
            <label for="type">User Type / Role</label>
            <select id="type" name="type" required>
                <option value="Admin">Admin</option>
                <option value="Doctor">Doctor</option>
                <option value="Front Desk">Front Desk</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Lab">Lab</option>
                <option value="Groomer">Groomer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add User</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
