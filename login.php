<?php
session_start();
require_once 'includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Using prepared statements to prevent SQL injection
    $sql = "SELECT * FROM admin_user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Plain text password check as requested by user
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['type']; // 'type' column seems to hold the role

            // Redirect based on role
            switch ($user['type']) {
                case 'Admin':
                    header("Location: admin/dashboard.php");
                    break;
                case 'Doctor':
                    header("Location: doctor/dashboard.php");
                    break;
                case 'Front Desk':
                    header("Location: front-desk/dashboard.php");
                    break;
                case 'Pharmacy':
                    header("Location: pharmacy/dashboard.php");
                    break;
                case 'Lab':
                    header("Location: lab/dashboard.php");
                    break;
                case 'Groomer':
                    header("Location: groomer/dashboard.php");
                    break;
                default:
                    header("Location: index.php?error=Invalid role");
                    break;
            }
            exit();
        }
    }

    header("Location: index.php?error=Invalid username or password");
    exit();

} else {
    header("Location: index.php");
    exit();
}
?>
