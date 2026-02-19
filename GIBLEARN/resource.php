<?php 
session_start();
include "includes/db.php";
$BASE_URL = "/Parent_folder/GIBLEARN";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resources • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/resource.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<!-- HERO -->
<section class="resource-hero">
    <h1>Learning Resources</h1>
    <p>Explore notes, worksheets, videos, and tools to support your learning journey.</p>
</section>

<!-- CATEGORY FILTERS -->
<section class="resource-categories">
    <button class="cat-btn active" data-filter="all">All</button>
    <button class="cat-btn" data-filter="maths">Maths</button>
    <button class="cat-btn" data-filter="science">Science</button>
    <button class="cat-btn" data-filter="english">English</button>
    <button class="cat-btn" data-filter="ict">ICT</button>
</section>

<!-- RESOURCE GRID -->
<section class="resource-grid">

    <div class="resource-card" data-category="maths">
        <i class="fa-solid fa-file-lines"></i>
        <h3>Maths Revision Notes</h3>
        <p>Download structured notes to help you master key maths concepts.</p>
        <a href="#" class="download-btn"><i class="fa-solid fa-download"></i> Download</a>
    </div>

    <div class="resource-card" data-category="science">
        <i class="fa-solid fa-video"></i>
        <h3>Science Video Lessons</h3>
        <p>Watch engaging lessons covering physics, chemistry, and biology.</p>
        <a href="#" class="download-btn"><i class="fa-solid fa-play"></i> Watch</a>
    </div>

    <div class="resource-card" data-category="english">
        <i class="fa-solid fa-book"></i>
        <h3>English Literature Guide</h3>
        <p>Summaries, analysis, and key themes for major literature texts.</p>
        <a href="#" class="download-btn"><i class="fa-solid fa-download"></i> Download</a>
    </div>

    <div class="resource-card" data-category="ict">
        <i class="fa-solid fa-laptop-code"></i>
        <h3>ICT Practice Worksheets</h3>
        <p>Improve your computer skills with hands‑on exercises.</p>
        <a href="#" class="download-btn"><i class="fa-solid fa-download"></i> Download</a>
    </div>

</section>

<!-- CTA -->
<section class="resource-cta">
    <h2>Want More Learning Tools?</h2>
    <p>Join GibLearn to access full courses, quizzes, messaging, and personalised learning.</p>
    <a href="<?= $BASE_URL ?>/register.php" class="cta-btn">Create Your Account</a>
</section>

<?php include "includes/footer.php"; ?>
<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>
