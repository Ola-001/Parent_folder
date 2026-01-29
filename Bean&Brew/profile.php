<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['user_name'];
$email = $_SESSION['user_email'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "header.php"; ?>

<div class="profile-container">
    <h1>Welcome, <?= htmlspecialchars($name) ?>!</h1>
    <p>Email: <?= htmlspecialchars($email) ?></p>
    <a href="logout.php">Logout</a>
</div>

<?php include "footer.php"; ?>

<script src="js/style.js"></script>

</body>
</html>
