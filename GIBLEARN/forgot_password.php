<?php
session_start();
include "includes/db.php";

// Base URL for your project
$BASE_URL = "/Parent_folder/GIBLEARN";

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['reset_email'] = $email;
        header("Location: reset_password.php");
        exit;
    } else {
        $message = "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/auth.css">
</head>
<body>

<div class="forms-container">
    <div class="form-card">

        <h2>Reset Password</h2>
        <p class="auth-subtitle">Enter your email to continue</p>

        <?php if (!empty($message)): ?>
            <p class="error"><?= $message ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <button type="submit">Continue</button>
        </form>

        <p class="switch-msg">
            Remembered your password?
            <a href="login.php">Login</a>
        </p>

    </div>
</div>

</body>
</html>
