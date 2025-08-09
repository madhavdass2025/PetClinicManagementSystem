<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: staff.php");
    exit();
}
$staff_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn->begin_transaction();
    try {
        // Staff details
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $role = $_POST['role'];

        // User credentials
        $username = $_POST['username'];

        // Update staff table
        $sql_staff = "UPDATE staff SET name=?, email=?, phone=?, address=?, role=? WHERE id=?";
        $stmt_staff = $conn->prepare($sql_staff);
        $stmt_staff->bind_param("sssssi", $name, $email, $phone, $address, $role, $staff_id);
        if (!$stmt_staff->execute()) {
            throw new Exception("Error updating staff: " . $stmt_staff->error);
        }

        // Update users table
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql_user = "UPDATE users SET username=?, role=?, password=? WHERE staff_id=?";
            $stmt_user = $conn->prepare($sql_user);
            $stmt_user->bind_param("sssi", $username, $role, $password, $staff_id);
        } else {
            $sql_user = "UPDATE users SET username=?, role=? WHERE staff_id=?";
            $stmt_user = $conn->prepare($sql_user);
            $stmt_user->bind_param("ssi", $username, $role, $staff_id);
        }

        if (!$stmt_user->execute()) {
            throw new Exception("Error updating user account: " . $stmt_user->error);
        }

        $conn->commit();
        echo "<script>alert('Staff member updated successfully'); window.location.href='staff.php';</script>";

    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

// Fetch current staff and user data
$sql = "SELECT s.*, u.username FROM staff s LEFT JOIN users u ON s.id = u.staff_id WHERE s.id = ? AND s.status = 'active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $staff_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: staff.php?error=Staff member not found");
    exit();
}
$staff = $result->fetch_assoc();
?>

<h2>Edit Staff Member</h2>

<div class="card">
    <form action="staff_edit.php?id=<?= $staff_id ?>" method="post">
        <h4>Staff Details</h4>
        <div class="input-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($staff['name']) ?>" required>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($staff['email']) ?>">
        </div>
        <div class="input-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($staff['phone']) ?>">
        </div>
        <div class="input-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" rows="3"><?= htmlspecialchars($staff['address']) ?></textarea>
        </div>
        <div class="input-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="Doctor" <?= $staff['role'] == 'Doctor' ? 'selected' : '' ?>>Doctor</option>
                <option value="Front Desk" <?= $staff['role'] == 'Front Desk' ? 'selected' : '' ?>>Front Desk</option>
                <option value="Pharmacy" <?= $staff['role'] == 'Pharmacy' ? 'selected' : '' ?>>Pharmacy</option>
                <option value="Lab" <?= $staff['role'] == 'Lab' ? 'selected' : '' ?>>Lab</option>
                <option value="Groomer" <?= $staff['role'] == 'Groomer' ? 'selected' : '' ?>>Groomer</option>
            </select>
        </div>
        <hr>
        <h4>Login Credentials</h4>
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($staff['username']) ?>" required>
        </div>
        <div class="input-group">
            <label for="password">New Password (leave blank to keep current)</label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Update Staff Member</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
