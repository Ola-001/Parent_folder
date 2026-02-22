<?php
session_start();
$BASE_URL = "/Parent_folder/GIBLEARN";

// Protect admin route
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: $BASE_URL/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard • GibLearn</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/tutor.css">
</head>
<body>

<!-- ADMIN HEADER -->
        <?php include "../includes/header.php"; ?>

<div class="admin-wrapper">

    <h1 class="admin-title">
        <i class="fa-solid fa-gauge"></i> Dashboard Overview
    </h1>

    <!-- STAT CARDS -->
    <div class="admin-stats-grid">

        <div class="admin-stat-card">
            <i class="fa-solid fa-users"></i>
            <h3>Total Users</h3>
            <p>1,240</p>
        </div>

        <div class="admin-stat-card">
            <i class="fa-solid fa-user-graduate"></i>
            <h3>Students</h3>
            <p>980</p>
        </div>

        <div class="admin-stat-card">
            <i class="fa-solid fa-chalkboard-user"></i>
            <h3>Tutors</h3>
            <p>60</p>
        </div>

        <div class="admin-stat-card">
            <i class="fa-solid fa-book"></i>
            <h3>Courses</h3>
            <p>145</p>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="admin-charts-row">

        <div class="admin-chart-box">
            <h3>User Growth</h3>
            <div class="admin-chart-placeholder">User Growth Chart</div>
        </div>

        <div class="admin-chart-box">
            <h3>Revenue Overview</h3>
            <div class="admin-chart-placeholder">Revenue Chart</div>
        </div>

    </div>

    <!-- RECENT ACTIVITY -->
    <div class="admin-panel">
        <h3>Recent Activity</h3>

        <ul class="admin-activity-list">
            <li>
                <i class="fa-solid fa-user-plus"></i>
                <div>
                    <strong>New user registered</strong>
                    <span>2 minutes ago</span>
                </div>
            </li>

            <li>
                <i class="fa-solid fa-check"></i>
                <div>
                    <strong>Course "Intro to Python" approved</strong>
                    <span>30 minutes ago</span>
                </div>
            </li>

            <li>
                <i class="fa-solid fa-flag"></i>
                <div>
                    <strong>Report submitted on "Web Dev Basics"</strong>
                    <span>1 hour ago</span>
                </div>
            </li>
        </ul>
    </div>

</div>

<?php include "../includes/footer.php"; ?>
<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>
