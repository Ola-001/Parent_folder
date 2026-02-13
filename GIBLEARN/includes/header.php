<?php

// Base URL for your project
$BASE_URL = "/Parent_folder/GIBLEARN";
?>

<header>
    <div class="nav-container">

        <!-- LOGO -->
        <div class="logo">
            <a href="<?= $BASE_URL ?>/index.php">
                <img src="<?= $BASE_URL ?>/images/LOGO.png" alt="GIBLEARN Logo">
            </a>
        </div>

        <!-- NAVIGATION -->
        <?php if(!isset($_SESSION['user_id'])): ?>

            <nav class="nav-links">
                <a href="<?= $BASE_URL ?>/index.php">Home</a>
                <a href="<?= $BASE_URL ?>/about.php">How it works</a>
                <a href="<?= $BASE_URL ?>/resource.php">Resource</a>
                <a href="<?= $BASE_URL ?>/login.php">Login</a>
                <a href="<?= $BASE_URL ?>/register.php">Register</a>
            </nav>

        <?php else: ?>
            <?php $role = $_SESSION['role'] ?? null; ?>
            <nav class="nav-links"> 
                <?php if ($role === 'student'): ?>
                    <a href="<?= $BASE_URL ?>/student/student_dash.php">Dashboard</a>
                    <a href="<?= $BASE_URL ?>/student/course.php">Courses</a>
                    <a href="<?= $BASE_URL ?>/messaging/inbox.php">Messages</a>
                    <a href="<?= $BASE_URL ?>/profile.php">Profile</a>
                    <a href="<?= $BASE_URL ?>/settings.php">Settings</a>
                    <a href="<?= $BASE_URL ?>/logout.php">Logout</a>
                    <a href="<?= $BASE_URL ?>/profile.php">Profile</a>

                <?php elseif ($role === 'tutor'): ?>
                    <a href="<?= $BASE_URL ?>/tutor/tutor_dash.php">Dashboard</a>
                    <a href="<?= $BASE_URL ?>/tutor/create_course.php">Create Course</a>
                    <a href="<?= $BASE_URL ?>/messaging/inbox.php">Messages</a>
                    <a href="<?= $BASE_URL ?>/profile.php">Profile</a>
                    <a href="<?= $BASE_URL ?>/settings.php">Settings</a>
                    <a href="<?= $BASE_URL ?>/logout.php">Logout</a>
                    <a href="<?= $BASE_URL ?>/profile.php">Profile</a>

                <?php elseif ($role === 'admin'): ?>
                    <a href="<?= $BASE_URL ?>/admin/admin_dash.php">Dashboard</a>
                    <a href="<?= $BASE_URL ?>/admin/manage_users.php">Manage Users</a>
                    <a href="<?= $BASE_URL ?>/admin/approve_courses.php">Approve Courses</a>
                    <a href="<?= $BASE_URL ?>/admin/reports.php">Reports</a>
                    <a href="<?= $BASE_URL ?>/settings.php">Settings</a>
                    <a href="<?= $BASE_URL ?>/logout.php">Logout</a>
                    <a href="<?= $BASE_URL ?>/profile.php">Profile</a>
                <?php endif; ?>
            </nav>
        <?php endif; ?>

        <!-- HAMBURGER (MOBILE ONLY) -->
        <span class="hamburger" onclick="openMenu()">&#9776;</span>

    </div>
</header>

<!-- MOBILE MENU OVERLAY -->
<div id="mobileMenu" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>

    <div class="overlay-content">
        <a href="<?= $BASE_URL ?>/index.php">Home</a>
        <a href="<?= $BASE_URL ?>/about.php">How it works</a>
        <a href="<?= $BASE_URL ?>/resource.php">Resource</a>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="<?= $BASE_URL ?>/login.php">Login</a>
            <a href="<?= $BASE_URL ?>/register.php">Register</a>
        <?php else: ?>
            <?php if ($_SESSION['role'] === 'student'): ?>
                <a href="<?= $BASE_URL ?>/student/student_dash.php">Dashboard</a>
                <a href="<?= $BASE_URL ?>/student/course.php">Courses</a>
                <a href="<?= $BASE_URL ?>/messaging/inbox.php">Messages</a>
                <a href="<?= $BASE_URL ?>/profile.php">Profile</a>
                <a href="<?= $BASE_URL ?>/settings.php">Settings</a>
                <a href="<?= $BASE_URL ?>/logout.php">Logout</a>
                <a href="<?= $BASE_URL ?>/profile.php">Profile</a>

            <?php elseif ($_SESSION['role'] === 'tutor'): ?>
                <a href="<?= $BASE_URL ?>/tutor/tutor_dash.php">Dashboard</a>
                <a href="<?= $BASE_URL ?>/tutor/create_course.php">Create Course</a>
                <a href="<?= $BASE_URL ?>/messaging/inbox.php">Messages</a>
                <a href="<?= $BASE_URL ?>/profile.php">Profile</a>
                <a href="<?= $BASE_URL ?>/settings.php">Settings</a>
                <a href="<?= $BASE_URL ?>/logout.php">Logout</a>
                <a href="<?= $BASE_URL ?>/profile.php">Profile</a>

            <?php elseif ($_SESSION['role'] === 'admin'): ?>
                <a href="<?= $BASE_URL ?>/admin/admin_dash.php">Dashboard</a>
                <a href="<?= $BASE_URL ?>/admin/manage_users.php">Manage Users</a>
                <a href="<?= $BASE_URL ?>/admin/approve_courses.php">Approve Courses</a>
                <a href="<?= $BASE_URL ?>/admin/reports.php">Reports</a>
                <a href="<?= $BASE_URL ?>/settings.php">Settings</a>
                <a href="<?= $BASE_URL ?>/logout.php">Logout</a>
                <a href="<?= $BASE_URL ?>/profile.php">Profile</a>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</div>