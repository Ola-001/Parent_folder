<?php
session_start();
include "includes/db.php";
$BASE_URL = "/Parent_folder/GIBLEARN";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit; 
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$stmt = $conn->prepare("SELECT name, email, role FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/profile.css">
</head>
<body>

<div class="profile-container">

    <div class="profile-card">

        <div class="profile-header">
            <img src="../images/default-avatar.png" class="profile-avatar">
            <h2><?= htmlspecialchars($user['name']) ?></h2>
            <p class="role-tag"><?= ucfirst($user['role']) ?></p>
        </div>

        <div class="profile-info">
            <h3>Account Information</h3>

            <div class="info-row">
                <span class="label">Full Name:</span>
                <span class="value"><?= htmlspecialchars($user['name']) ?></span>
            </div>

            <div class="info-row">
                <span class="label">Email Address:</span>
                <span class="value"><?= htmlspecialchars($user['email']) ?></span>
            </div>

            <div class="info-row">
                <span class="label">Role:</span>
                <span class="value"><?= ucfirst($user['role']) ?></span>
            </div>
        </div>

        <div class="profile-actions">
            <a href="edit_profile.php" class="btn edit">Edit Profile</a>
            <a href="../logout.php" class="btn logout">Logout</a>
        </div>

    </div>

</div>

</body>
</html>
