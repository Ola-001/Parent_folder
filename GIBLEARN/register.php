<?php
session_start();
include "includes/db.php";

// Base URL for your project
$BASE_URL = "/Parent_folder/GIBLEARN";

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    if ($name === "" || $email === "" || $password === "" || $confirm === "") {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {

        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            // Hash password
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // Insert user
            $role = $_POST['role'];
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $hashed, $role);


            if ($stmt->execute()) {
                $success = "Account created successfully! You can now log in.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/auth.css">
</head>
<body>

        <div class="auth-logo">
            <a href="<?= $BASE_URL ?>/index.php">
                <img src="<?= $BASE_URL ?>/images/MEE.png" alt="GIBLEARN Logo">
            </a>
        </div>
<div class="forms-container">
    <div class="form-card">
        <h2>Create Account</h2>
        <p class="auth-subtitle">Join GibLearn and start your learning journey</p>

        <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>

        <form method="POST">

            <div class="input-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Create a password" required>
            </div>

            <div class="input-group">
                <label>Select Role</label>
                <select name="role" required>
                    <option value="student">Student</option>
                    <option value="tutor">Tutor</option>
                </select>
            </div>


            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm" placeholder="Confirm your password" required>
            </div>

            <button type="submit">Register</button>
        </form>

        <p class="switch-msg">
            Already have an account?
            <a href="login.php">Login</a>
        </p>

    </div>
</div>

</body>
</html>
