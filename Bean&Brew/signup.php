<?php
session_start();
include("db.php");

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' LIMIT 1");

    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered.";
    } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            $success = "Account created! You can now log in.";
        } else {
            $error = "Something went wrong. Try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beans & Brew • Sign Up</title>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>

<div class="page-wrapper">

    <div class="hero">
        <div class="overlay"></div>

        <div class="brand">
            <a href="index.php" class="logo">
                <img src="img/logo.png" alt="Beans & Brew Logo">
            </a>
            <h1>Beans & Brew</h1>
        </div>

        <p>Create an account to continue.</p>
    </div>

    <div class="forms-container">
        <div class="form-card">

            <h2>Sign Up</h2>

            <?php if (!empty($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <p class="success"><?= $success ?></p>
            <?php endif; ?>

            <form method="POST">

                <div class="input-group">
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>

                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit">Create Account</button>
            </form>

            <p class="switch-msg">
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </div>
    </div>

</div>

<script src="js/style.js"></script>

</body>
</html>
