<?php
session_start();
include "includes/db.php";
$BASE_URL = "/Parent_folder/GIBLEARN";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit; 
}

$user_id = $_SESSION['user_id'];

/* FETCH USER INFO */
$stmt = $conn->prepare("SELECT name, email, role, bio, created_at, theme FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$theme = $user['theme'] ?? 'light';

/* COUNT ENROLLED COURSES */
$sql = "SELECT COUNT(*) AS total FROM enrollments WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$courses_count = $stmt->get_result()->fetch_assoc()['total'];

/* FETCH 3 RECENT COURSES */
$sql = "SELECT c.id, c.title, c.thumbnail
        FROM enrollments e
        JOIN courses c ON e.course_id = c.id
        WHERE e.student_id = ?
        ORDER BY e.enrolled_at DESC
        LIMIT 3";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$three_courses = $stmt->get_result();

/* COUNT UNREAD MESSAGES */
$sql = "SELECT COUNT(*) AS total FROM notifications WHERE student_id = ? AND is_read = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$messages_count = $stmt->get_result()->fetch_assoc()['total'];

/* COUNT COMPLETED LESSONS */
$sql = "SELECT COUNT(*) AS total FROM lesson_progress WHERE student_id = ? AND is_completed = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$completed_lessons = $stmt->get_result()->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/pro.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="<?= $theme ?>">

<?php include "includes/header.php"; ?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-video-container">
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="<?= $BASE_URL ?>/videos/hero.mp4" type="video/mp4">
        </video>
    </div>

    <div class="profile-info">
        <img src="<?= $BASE_URL ?>/images/default-avatar.png" class="profile-avatar">
        <h2><?= htmlspecialchars($user['name']) ?></h2>
        <span class="role-badge"><?= ucfirst($user['role']) ?></span>
    </div>
</section>

<!-- STATS SECTION -->
<div class="profile-stats">

    <div class="stat-card">
        <i class="fa-solid fa-book"></i>
        <h4>Courses</h4>
        <p><?= $courses_count ?> Enrolled</p>
    </div>

    <div class="stat-card">
        <i class="fa-solid fa-envelope"></i>
        <h4>Messages</h4>
        <p><?= $messages_count ?> New</p>
    </div>

    <div class="stat-card">
        <i class="fa-solid fa-check-circle"></i>
        <h4>Completed</h4>
        <p><?= $completed_lessons ?> Lessons</p>
    </div>

    <div class="stat-card">
        <i class="fa-solid fa-calendar"></i>
        <h4>Joined</h4>
        <p><?= date("Y", strtotime($user['created_at'])) ?></p>
    </div>

</div>

<!-- MAIN PROFILE BODY -->
<div class="profile-container">

    <!-- LEFT COLUMN -->
    <div class="profile-left">

        <!-- QUICK ACTIONS -->
        <div class="profile-card">
            <h3>Quick Actions</h3>

            <a href="edit_profile.php" class="quick-btn">
                <i class="fa-solid fa-user-pen"></i> Edit Profile
            </a>

            <a href="change_password.php" class="quick-btn">
                <i class="fa-solid fa-lock"></i> Change Password
            </a>

            <form action="toggle_theme.php" method="POST">
                <button type="submit" class="quick-btn">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                    Switch to <?= ($theme === 'light') ? 'Dark' : 'Light' ?> Mode
                </button>
            </form>

            <a href="<?= $BASE_URL ?>/logout.php" class="quick-btn logout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>

        <!-- PROFILE COMPLETION -->
        <div class="profile-card">
            <h3>Profile Completion</h3>

            <div class="progress-bar">
                <div class="progress-fill" style="width: 70%;"></div>
            </div>

            <p>70% Complete</p>
        </div>

    </div>

    <!-- RIGHT COLUMN -->
    <div class="profile-right">

        <!-- ACCOUNT INFO -->
        <div class="profile-card">
            <h3>Account Information</h3>

            <p><strong>Full Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Role:</strong> <?= ucfirst($user['role']) ?></p>
        </div>

        <!-- ABOUT ME -->
        <div class="profile-card">
            <h3>About Me</h3>
            <p><?= $user['bio'] ? htmlspecialchars($user['bio']) : "No bio added yet." ?></p>
        </div>

        <!-- STUDENT COURSES (3) -->
        <?php if ($user['role'] === 'student'): ?>
        <div class="profile-card">
            <h3>Your Courses</h3>

            <?php if ($three_courses->num_rows === 0): ?>
                <p>You are not enrolled in any courses yet.</p>
            <?php else: ?>
                <div class="course-mini-list">
                    <?php while ($c = $three_courses->fetch_assoc()): ?>
                        <div class="course-mini-item">
                            <img src="<?= htmlspecialchars($c['thumbnail'] ?? "$BASE_URL/images/course-placeholder.jpg") ?>" class="course-mini-thumb">
                            <span><?= htmlspecialchars($c['title']) ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <a href="<?= $BASE_URL ?>/student/course.php" class="quick-btn">View All Courses</a>
        </div>
        <?php endif; ?>

        <!-- TUTOR SECTION -->
        <?php if ($user['role'] === 'tutor'): ?>
        <div class="profile-card">
            <h3>Subjects I Teach</h3>
            <ul class="subject-list">
                <li>Maths</li>
                <li>Science</li>
                <li>ICT</li>
            </ul>
        </div>
        <?php endif; ?>

        <!-- ADMIN SECTION -->
        <?php if ($user['role'] === 'admin'): ?>
        <div class="profile-card">
            <h3>Admin Tools</h3>
            <a href="../admin/manage_users.php" class="quick-btn">Manage Users</a>
            <a href="../admin/approve_courses.php" class="quick-btn">Approve Courses</a>
            <a href="../admin/reports.php" class="quick-btn">View Reports</a>
        </div>
        <?php endif; ?>

    </div>

</div>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>
</body>
</html>
