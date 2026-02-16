<?php 
session_start();
include "includes/db.php";
$BASE_URL = "/Parent_folder/GIBLEARN";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>How It Works • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/how.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<!-- PAGE HERO -->
<section class="page-hero">
    <h1>How GibLearn Works</h1>
    <p>Your journey to personalised learning starts here.</p>
</section>

<!-- STEP SECTION -->
<section class="howitworks-steps">

    <div class="step-card">
        <span class="step-number">1</span>
        <h3>Create Your Account</h3>
        <p>Sign up as a student or tutor in just a few clicks. Your profile helps us personalise your experience.</p>
    </div>

    <div class="step-card">
        <span class="step-number">2</span>
        <h3>Explore Courses & Tutors</h3>
        <p>Browse subjects, view tutor profiles, and explore courses designed to help you succeed.</p>
    </div>

    <div class="step-card">
        <span class="step-number">3</span>
        <h3>Start Learning</h3>
        <p>Access modules, resources, quizzes, and messaging tools — all in one place.</p>
    </div>

    <div class="step-card">
        <span class="step-number">4</span>
        <h3>Track Your Progress</h3>
        <p>Complete quizzes, review your scores, and stay on top of your learning journey.</p>
    </div>

</section>

<!-- FEATURES SECTION -->
<section class="features-section">
    <h2>Everything You Need to Learn Effectively</h2>

    <div class="features-grid">

        <div class="feature-box">
            <i class="fa-solid fa-video"></i>
            <h3>Interactive Learning</h3>
            <p>Engage with video lessons, notes, and interactive modules created by expert tutors.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-comments"></i>
            <h3>Direct Messaging</h3>
            <p>Ask questions, get feedback, and stay connected with your tutor anytime.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-file-lines"></i>
            <h3>Resources & Materials</h3>
            <p>Access downloadable notes, worksheets, and additional study materials.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-check-circle"></i>
            <h3>Quizzes & Assessments</h3>
            <p>Test your knowledge with built‑in quizzes and track your improvement.</p>
        </div>

    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <h2>Ready to Begin?</h2>
    <a href="<?= $BASE_URL ?>/register.php" class="hero-btn">Join GibLearn Today</a>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
