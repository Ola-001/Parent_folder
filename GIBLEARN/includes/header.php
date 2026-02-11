<?php 
session_start(); 
?>

<header> 
    <?php if(!isset($_SESSION['user_id'])): ?>
        <!-- PUBLIC HEADER -->
        <nav>
            <a href="/GIBLEARN/index.php">Home</a>
            <a href="/GIBLEARN/about.php">How it works</a>
            <a href="/GIBLEARN/resource.php">Resource</a>
            <a href="/GIBLEARN/login.php">Login</a>
            <a href="/GIBLEARN/register.php">Register</a>
        </nav>

    <?php else: ?>
        <!-- LOGGED-IN HEADER -->
        <?php $role = $_SESSION['role']; ?>

        <nav>
            <?php if ($role === 'student'): ?>
                <a href="/GIBLEARN/student/student_dash.php">Dashboard</a>
                <a href="/GIBLEARN/student/course.php">Courses</a>
                <a href="/GIBLEARN/messaging/inbox.php">Messages</a>
                <a href="/GIBLEARN/profile.php">Profile</a>
                <a href="/GIBLEARN/settings.php">Settings</a>
                <a href="/GIBLEARN/logout.php">Logout</a>

            <?php elseif ($role === 'tutor'): ?>
                <a href="/GIBLEARN/tutor/tutor_dash.php">Dashboard</a>
                <a href="/GIBLEARN/tutor/create_course.php">Create Course</a>
                <a href="/GIBLEARN/messaging/inbox.php">Messages</a>
                <a href="/GIBLEARN/profile.php">Profile</a>
                <a href="/GIBLEARN/settings.php">Settings</a>
                <a href="/GIBLEARN/logout.php">Logout</a>

            <?php elseif ($role === 'admin'): ?>
                <a href="/GIBLEARN/admin/admin_dash.php">Dashboard</a>
                <a href="/GIBLEARN/admin/manage_users.php">Manage Users</a>
                <a href="/GIBLEARN/admin/approve_courses.php">Approve Courses</a>
                <a href="/GIBLEARN/admin/reports.php">Reports</a>
                <a href="/GIBLEARN/settings.php">Settings</a>
                <a href="/GIBLEARN/logout.php">Logout</a>
            <?php endif; ?>
        </nav>

    <?php endif; ?>
</header>
