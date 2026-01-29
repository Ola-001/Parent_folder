<?php
session_start();
include("db.php");

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: profile.php");
            exit;

        } else {
            $error = "Incorrect password.";
        }

    } else {
        $error = "No account found with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beans & Brew • Login</title>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>



    <div class="hero">
        <div class="brand">
            <a href="index.php" class="logo">
                <img src="img/logo.png" alt="Beans & Brew Logo">
            </a>
            <h1>Beans & Brew</h1>
        </div>

        <p>Fresh coffee. Warm moments.</p>
    </div>

    <div class="forms-container">
        <div class="form-card">

            <h2>Login</h2>

            <?php if (!empty($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>

            <form method="POST">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit">Login</button>
            </form>

            <p class="switch-msg">
                Don't have an account?
                <a href="signup.php">Sign Up</a>
            </p>

        </div>
    </div>
    



<script src="js/style.js"></script>
</body>
</html>
