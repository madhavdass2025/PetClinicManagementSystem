<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}
$user_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $type = $_POST['type'];

    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $sql = "UPDATE admin_user SET username=?, password=?, type=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $password, $type, $user_id);
    } else {
        $sql = "UPDATE admin_user SET username=?, type=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $type, $user_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully'); window.location.href='users.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch current user data
$sql = "SELECT * FROM admin_user WHERE id = ? AND cancel = '0'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: users.php?error=User not found");
    exit();
}
$user = $result->fetch_assoc();
?>

<h2>Edit User</h2>

<div class="card">
    <form action="user_edit.php?id=<?= $user_id ?>" method="post">
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>
        <div class="input-group">
            <label for="password">New Password (leave blank to keep current)</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="input-group">
            <label for="type">User Type / Role</label>
            <select id="type" name="type" required>
                <option value="Admin" <?= $user['type'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                <option value="Doctor" <?= $user['type'] == 'Doctor' ? 'selected' : '' ?>>Doctor</option>
                <option value="Front Desk" <?= $user['type'] == 'Front Desk' ? 'selected' : '' ?>>Front Desk</option>
                <option value="Pharmacy" <?= $user['type'] == 'Pharmacy' ? 'selected' : '' ?>>Pharmacy</option>
                <option value="Lab" <?= $user['type'] == 'Lab' ? 'selected' : '' ?>>Lab</option>
                <option value="Groomer" <?= $user['type'] == 'Groomer' ? 'selected' : '' ?>>Groomer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
