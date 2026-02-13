<?php
session_start();
include "includes/db.php";

// Base URL for your project
$BASE_URL = "/Parent_folder/GIBLEARN";

$error = "";

// If user is already logged in, redirect them based on role
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    $role = $_SESSION['role'];

    if ($role === "student") {
        header("Location: $BASE_URL/student/student_dash.php");
        exit;
    } elseif ($role === "tutor") {
        header("Location: $BASE_URL/tutor/tutor_dash.php");
        exit;
    } elseif ($role === "admin") {
        header("Location: $BASE_URL/admin/admin_dash.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === "" || $password === "") {
        $error = "Please fill in all fields.";
    } else {
        // Prepared statement for security
        $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {

                // Store session data
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === "student") {
                    header("Location: $BASE_URL/student/student_dash.php");
                } elseif ($user['role'] === "tutor") {
                    header("Location: $BASE_URL/tutor/tutor_dash.php");
                } elseif ($user['role'] === "admin") {
                    header("Location: $BASE_URL/admin/admin_dash.php");
                }
                exit;

            } else {
                $error = "Incorrect password.";
            }

        } else {
            $error = "No account found with that email.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/auth.css">
</head>
<body>

<div class="auth-container">
        <div class="auth-logo">
            <a href="<?= $BASE_URL ?>/index.php">
                <img src="<?= $BASE_URL ?>/images/MEE.png" alt="GIBLEARN Logo">
            </a>
        </div>

    <div class="auth-card">

        <h2>Welcome</h2>
        <p class="auth-subtitle">Log in to continue your learning journey</p>

        <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">

            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="auth-btn">Login</button>

            <div class="forgot-password">
                <a href="forgot_password.php">Forgot your password?</a>
            </div>

        </form>

        <p class="switch-msg">
            New to GibLearn?
            <a href="register.php">Create an account</a>
        </p>

    </div>

</div>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>
</body>
</html>
