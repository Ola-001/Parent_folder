<?php 
include "includes/db.php";
session_start();
$BASE_URL = "/Parent_folder/GIBLEARN";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
</head>
<body>

    <?php include "includes/header.php"; ?>

    <section class="hero">
        <div class="hero-video-container">
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="<?= $BASE_URL ?>/videos/hero.mp4" type="video/mp4">
            </video>
        </div>

        <div class="hero-content">
            <h1>Welcome to GibLearn</h1>
            <p>Your personalised tutoring platform designed for every learner.</p>
            <a href="<?= $BASE_URL ?>/register.php" class="hero-btn">Get Started</a>
        </div>
    </section>

    <?php include "includes/footer.php"; ?>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>
</body>
</html>
