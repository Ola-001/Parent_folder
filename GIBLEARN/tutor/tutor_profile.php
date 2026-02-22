<?php
session_start();
include "../includes/db.php";

$BASE_URL = "/Parent_folder/GIBLEARN";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* FETCH USER INFO */
$stmt = $conn->prepare("SELECT name, email, role, bio, avatar, created_at, theme 
                        FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$theme = $user['theme'] ?? 'light';

/* COUNT COURSES CREATED */
$sql = "SELECT COUNT(*) AS total FROM courses WHERE tutor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$total_courses = $stmt->get_result()->fetch_assoc()['total'];

/* COUNT TOTAL STUDENTS */
$sql = "SELECT COUNT(*) AS total 
        FROM enrollments e
        JOIN courses c ON e.course_id = c.id
        WHERE c.tutor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$total_students = $stmt->get_result()->fetch_assoc()['total'];

/* AVERAGE RATING */
$sql = "SELECT AVG(r.rating) AS avg_rating
        FROM reviews r
        JOIN courses c ON r.course_id = c.id
        WHERE c.tutor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$avg_rating = round($stmt->get_result()->fetch_assoc()['avg_rating'] ?? 0, 1);

/* FETCH 3 RECENT COURSES */
$sql = "SELECT id, title, thumbnail
        FROM courses
        WHERE tutor_id = ?
        ORDER BY created_at DESC
        LIMIT 3";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$courses = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tutor Profile • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/pro.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="<?= $theme ?>">

<?php include "../includes/header.php"; ?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-video-container">
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="<?= $BASE_URL ?>/videos/hero.mp4" type="video/mp4">
        </video>
    </div>

    <div class="profile-info">
        <img src="<?= $user['avatar'] 
            ? $BASE_URL . '/uploads/' . $user['avatar'] 
            : $BASE_URL . '/images/default-avatar.png' ?>" 
            class="profile-avatar">

        <h2><?= htmlspecialchars($user['name']) ?></h2>
        <span class="role-badge">Professional Tutor</span>
    </div>
</section>

<!-- STATS SECTION -->
<div class="profile-stats">

    <div class="stat-card">
        <i class="fa-solid fa-book-open"></i>
        <h4>Courses</h4>
        <p><?= $total_courses ?> Created</p>
    </div>

    <div class="stat-card">
        <i class="fa-solid fa-users"></i>
        <h4>Students</h4>
        <p><?= $total_students ?> Enrolled</p>
    </div>

    <div class="stat-card">
        <i class="fa-solid fa-star"></i>
        <h4>Rating</h4>
        <p><?= $avg_rating ?> / 5.0</p>
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

        <div class="profile-card">
            <h3>Quick Actions</h3>

            <a href="create_course.php" class="quick-btn">
                <i class="fa-solid fa-plus"></i> Create Course
            </a>

            <a href="manage_courses.php" class="quick-btn">
                <i class="fa-solid fa-gear"></i> Manage Courses
            </a>

            <a href="edit_profile.php" class="quick-btn">
                <i class="fa-solid fa-user-pen"></i> Edit Profile
            </a>

            <form action="../toggle_theme.php" method="POST">
                <button type="submit" class="quick-btn">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                    Switch to <?= ($theme === 'light') ? 'Dark' : 'Light' ?> Mode
                </button>
            </form>

            <a href="<?= $BASE_URL ?>/logout.php" class="quick-btn logout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>

        <!-- PERFORMANCE -->
        <div class="profile-card">
            <h3>Performance Overview</h3>

            <div class="progress-bar">
                <div class="progress-fill" style="width: <?= min($avg_rating * 20, 100) ?>%;"></div>
            </div>

            <p><?= $avg_rating ?> / 5 Instructor Rating</p>
        </div>

    </div>

    <!-- RIGHT COLUMN -->
    <div class="profile-right">

        <div class="profile-card">
            <h3>Account Information</h3>

            <p><strong>Full Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Role:</strong> Tutor</p>
        </div>

        <div class="profile-card">
            <h3>About Me</h3>
            <p><?= $user['bio'] ? htmlspecialchars($user['bio']) : "No bio added yet." ?></p>
        </div>

        <div class="profile-card">
            <h3>My Courses</h3>

            <?php if ($courses->num_rows === 0): ?>
                <p>You have not created any courses yet.</p>
            <?php else: ?>
                <div class="course-mini-list">
                    <?php while ($c = $courses->fetch_assoc()): ?>
                        <div class="course-mini-item">
                            <img src="<?= htmlspecialchars($c['thumbnail'] ?? "$BASE_URL/images/course-placeholder.jpg") ?>" class="course-mini-thumb">
                            <span><?= htmlspecialchars($c['title']) ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <a href="manage_courses.php" class="quick-btn">View All Courses</a>
        </div>

    </div>

</div>

<?php include "../includes/footer.php"; ?>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>
</body>
</html>