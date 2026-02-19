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

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-video-container">
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="<?= $BASE_URL ?>/videos/hero.mp4" type="video/mp4">
        </video>
    </div>

    <div class="hero-content">
        <h1>Your Learning Journey Starts Here</h1>
        <p>Whether you're studying, teaching, or managing, GibLearn gives you the tools to grow.</p>
        <a href="<?= $BASE_URL ?>/register.php" class="hero-btn">Get Started</a>
    </div>
</section>

<!-- TRUST SECTION -->
<section class="trust-section">
    <div class="trust-container">
        <p>Trusted by students, parents, and tutors across Gibraltar</p>
        <div class="trust-logos">
            <span><i class="fa-solid fa-star"></i> 4.9/5 Rating</span>
            <span><i class="fa-solid fa-user-graduate"></i> Expert Tutors</span>
            <span><i class="fa-solid fa-shield-halved"></i> Safe & Secure</span>
        </div>
    </div>
</section>

<!-- POPULAR SUBJECTS -->
<section class="subjects-section">
    <h2>Popular Subjects</h2>
    <div class="subjects-grid">

        <div class="subject-card">
            <i class="fa-solid fa-calculator"></i>
            <p>Maths</p>
        </div>

        <div class="subject-card">
            <i class="fa-solid fa-flask"></i>
            <p>Science</p>
        </div>

        <div class="subject-card">
            <i class="fa-solid fa-book"></i>
            <p>English</p>
        </div>

        <div class="subject-card">
            <i class="fa-solid fa-globe"></i>
            <p>Geography</p>
        </div>

        <div class="subject-card">
            <i class="fa-solid fa-language"></i>
            <p>Languages</p>
        </div>

        <div class="subject-card">
            <i class="fa-solid fa-laptop-code"></i>
            <p>Computer Science</p>
        </div>

    </div>
</section>



<!-- TUTOR SPOTLIGHT -->
<section class="tutor-spotlight">
    <h2>Meet Some of Our Top Tutors</h2>

    <div class="tutor-grid">

        <div class="tutor-card">
            <img src="<?= $BASE_URL ?>/images/MEE.png" alt="Tutor">
            <h3>Sarah Johnson</h3>
            <p>Maths & Physics Tutor</p>
            <span>⭐ 4.9 (120 reviews)</span>
        </div>

        <div class="tutor-card">
            <img src="<?= $BASE_URL ?>/images/MEE.png" alt="Tutor">
            <h3>Daniel Perez</h3>
            <p>English & Literature Tutor</p>
            <span>⭐ 4.8 (98 reviews)</span>
        </div>

        <div class="tutor-card">
            <img src="<?= $BASE_URL ?>/images/MEE.png" alt="Tutor">
            <h3>Maria Gomez</h3>
            <p>Biology & Chemistry Tutor</p>
            <span>⭐ 5.0 (140 reviews)</span>
        </div>

    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials-section">
    <h2>What Students Say</h2>

    <div class="testimonials-grid">

        <div class="testimonial-card">
            <p>"GibLearn helped me improve my grades faster than I expected. My tutor was amazing!"</p>
            <h4>— Emily, Student</h4>
        </div>

        <div class="testimonial-card">
            <p>"The platform is easy to use and the tutors are very professional."</p>
            <h4>— Michael, Parent</h4>
        </div>

        <div class="testimonial-card">
            <p>"As a tutor, I love how simple it is to manage my courses and students."</p>
            <h4>— Sarah, Tutor</h4>
        </div>

    </div>
</section>

<!-- CALL TO ACTION -->
<section class="cta-section">
    <h2>Ready to Start Learning?</h2>
    <a href="<?= $BASE_URL ?>/register.php" class="hero-btn">Join GibLearn Today</a>
</section>

<?php include "includes/footer.php"; ?>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>
</body>
</html>
