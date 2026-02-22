<?php
session_start();
$BASE_URL = "/Parent_folder/GIBLEARN";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tutor Dashboard • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/tutor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <?php include "../includes/header.php"; ?>

    <div class="tutor-dashboard">
        <h2 class="dash-title"><i class="fa-solid fa-gauge"></i> Tutor Dashboard</h2>

        <div class="stats-grid">
            <div class="stat-card">
            <i class="fa-solid fa-book"></i>
            <h3>Courses</h3>
            <p>4 Active</p>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-users"></i>
            <h3>Students</h3>
            <p>128 Enrolled</p>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-envelope"></i>
            <h3>Earnings</h3>
            <p>$1,240</p>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-star"></i>
            <h3>Rating</h3>
            <p>4.8 / 5</p>
        </div>
    </div>

    <div class="quick-actions">
         <a href="create_course.php" class="qa-btn">
            <i class="fa-solid fa-plus"></i> Create New Course
        </a>

        <a href="upload_resource.php" class="qa-btn">
            <i class="fa-solid fa-upload"></i> Upload Resources
        </a>

        <a href="analytics.php" class="qa-btn">
            <i class="fa-solid fa-chart-pie"></i> View Analytics
        </a>

        <a href="../includes/messaging/messages.php" class="qa-btn">
            <i class="fa-solid fa-envelope"></i> Messages
        </a>
    </div>

    <div class="section">
        <h3 class="section-title">My Courses</h3>

        <div class="course-list">

            <div class="course-card">
                <img src="<?= $BASE_URL ?>/images/about.jpg" class="course-thumb">
                <div class="course-info">
                    <h4>Web Development Basics</h4>
                    <p>56 Students • Published</p>
                </div>
            </div>

            <div class="course-card">
                <img src="<?= $BASE_URL ?>/images/about.jpg" class="course-thumb">
                <div class="course-info">
                    <h4>Introduction to Python</h4>
                    <p>32 Students • Published</p>
                </div>
            </div>

            <div class="course-card">
                <img src="<?= $BASE_URL ?>/images/about.jpg" class="course-thumb">
                <div class="course-info">
                    <h4>UI/UX Design for Beginners</h4>
                    <p>40 Students • Draft</p>
                </div>
            </div>

        </div>
    </div>

    <div class="section">
        <h3 class="section-title">Recent Activity</h3>

        <ul class="activity-feed">
            <li>
                <i class="fa-solid fa-user-plus"></i>
                <div>
                    <strong>John Doe</strong> enrolled in "Web Development Basics"
                    <span class="activity-time">2 hours ago</span>
                </div>
            </li>
            <li>
                <i class="fa-solid fa-star"></i>
                <div>
                    <strong>Jane Smith</strong> rated "Introduction to Python" 5 stars
                    <span class="activity-time">5 hours ago</span>
                </div>
            </li>
            <li>
                <i class="fa-solid fa-comment"></i>
                <div>
                    <strong>Emily Davis</strong> commented on "UI/UX Design for Beginners"
                    <span class="activity-time">1 day ago</span>
                </div>
            </li>
        </ul>
    </div>


    </div>

    <?php include "../includes/footer.php"; ?>
<script src="<?= $BASE_URL ?>/assets/style.js"></script>
</body>
</html>