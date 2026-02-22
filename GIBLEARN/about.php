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
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<!-- PAGE HERO -->
<section class="page-hero">
    <h1>How GibLearn Works</h1>
    <p>Your journey to personalised learning starts here.</p>
</section>

<section class="who-section">
    <h2>Who Is GibLearn For?</h2>

    <div class="who-grid">

        <div class="who-card">
            <i class="fa-solid fa-child-reaching"></i>
            <h3>Students</h3>
            <p>Improve grades, build confidence, and learn at your own pace with expert guidance.</p>
        </div>

        <div class="who-card">
            <i class="fa-solid fa-user-tie"></i>
            <h3>Tutors</h3>
            <p>Share your knowledge, grow your teaching career, and earn flexibly from anywhere.</p>
        </div>

        <div class="who-card">
            <i class="fa-solid fa-people-group"></i>
            <h3>Parents</h3>
            <p>Track your child’s progress and ensure they get the support they need to succeed.</p>
        </div>

    </div>
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

<section class="split-section">

    <div class="split-box">
        <h3>For Students</h3>
        <ul>
            <li>✔ Learn at your own pace</li>
            <li>✔ Access notes, videos & quizzes</li>
            <li>✔ Message tutors anytime</li>
            <li>✔ Track your progress</li>
        </ul>
    </div>

    <div class="split-box">
        <h3>For Tutors</h3>
        <ul>
            <li>✔ Create courses & modules</li>
            <li>✔ Manage your students</li>
            <li>✔ Upload resources</li>
            <li>✔ Earn flexibly</li>
        </ul>
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

<section class="why-works-section">
    <h2>Why GibLearn Works</h2>

    <div class="why-works-grid">

        <div class="why-works-card">
            <i class="fa-solid fa-brain"></i>
            <h3>Personalised Learning</h3>
            <p>Every learner gets a tailored experience designed to match their goals.</p>
        </div>

        <div class="why-works-card">
            <i class="fa-solid fa-clock"></i>
            <h3>Flexible Scheduling</h3>
            <p>Learn anytime, anywhere — no fixed timetable required.</p>
        </div>

        <div class="why-works-card">
            <i class="fa-solid fa-award"></i>
            <h3>Proven Results</h3>
            <p>Students consistently improve their grades and confidence.</p>
        </div>

    </div>
</section>

<section class="faq-section">
    <h2>Frequently Asked Questions</h2>

    <div class="faq-item">
        <h3>How do I sign up?</h3>
        <p>Simply create an account as a student or tutor and follow the guided steps.</p>
    </div>

    <div class="faq-item">
        <h3>Is GibLearn free?</h3>
        <p>Creating an account is free. Tutors may set their own pricing for lessons.</p>
    </div>

    <div class="faq-item">
        <h3>Can I learn multiple subjects?</h3>
        <p>Yes! You can join as many courses as you want.</p>
    </div>

</section>


<!-- CTA -->
<section class="cta-section">
    <h2>Ready to Begin?</h2>
    <a href="<?= $BASE_URL ?>/register.php" class="hero-btn">Join GibLearn Today</a>
</section>

<?php include "includes/footer.php"; ?>
<script src="<?= $BASE_URL ?>/assets/style.js"></script>
</body>
</html>
