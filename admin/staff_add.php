<?php
include 'includes/header.php';
require_once '../includes/db_connect.php';

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
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Insert into staff table
        $sql_staff = "INSERT INTO staff (name, email, phone, address, role) VALUES (?, ?, ?, ?, ?)";
        $stmt_staff = $conn->prepare($sql_staff);
        $stmt_staff->bind_param("sssss", $name, $email, $phone, $address, $role);
        if (!$stmt_staff->execute()) {
            throw new Exception("Error adding staff: " . $stmt_staff->error);
        }
        $staff_id = $conn->insert_id;

        // Insert into users table
        $sql_user = "INSERT INTO users (username, password, role, staff_id) VALUES (?, ?, ?, ?)";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param("sssi", $username, $password, $role, $staff_id);
        if (!$stmt_user->execute()) {
            throw new Exception("Error creating user account: " . $stmt_user->error);
        }

        $conn->commit();
        echo "<script>alert('Staff member added successfully'); window.location.href='staff.php';</script>";

    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>

<h2>Add New Staff Member</h2>

<div class="card">
    <form action="staff_add.php" method="post">
        <h4>Staff Details</h4>
        <div class="input-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div class="input-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone">
        </div>
        <div class="input-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" rows="3"></textarea>
        </div>
        <div class="input-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="Doctor">Doctor</option>
                <option value="Front Desk">Front Desk</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Lab">Lab</option>
                <option value="Groomer">Groomer</option>
            </select>
        </div>
        <hr>
        <h4>Login Credentials</h4>
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-success">Add Staff Member</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
