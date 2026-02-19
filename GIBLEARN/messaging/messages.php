<?php
session_start();
$BASE_URL = "/Parent_folder/GIBLEARN";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Messages • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/Pro.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php include "../includes/header.php"; ?>

<div class="messages-container">

    <h2 class="messages-title"><i class="fa-solid fa-envelope"></i> Messages</h2>

    <!-- Message 1 -->
    <div class="message-card unread">
        <div class="message-header">
            <h3>Welcome to GibLearn!</h3>
            <span class="message-date">Feb 18, 2026</span>
        </div>
        <p class="message-body">
            Thanks for joining our learning community. Start exploring courses and enjoy your journey!
        </p>
        <a class="mark-read-btn">Mark as Read</a>
    </div>

    <!-- Message 2 -->
    <div class="message-card unread">
        <div class="message-header">
            <h3>New Course Recommendation</h3>
            <span class="message-date">Feb 17, 2026</span>
        </div>
        <p class="message-body">
            Based on your interests, we think you’ll enjoy “Introduction to Web Development”.
        </p>
        <a class="mark-read-btn">Mark as Read</a>
    </div>

    <!-- Message 3 -->
    <div class="message-card read">
        <div class="message-header">
            <h3>Profile Updated Successfully</h3>
            <span class="message-date">Feb 15, 2026</span>
        </div>
        <p class="message-body">
            Your profile information has been updated. Keep your details fresh!
        </p>
    </div>

</div>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>
</body>
</html>
