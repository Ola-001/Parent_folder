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
$stmt = $conn->prepare("SELECT name, email, role, avatar, theme, created_at 
                        FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$theme = $user['theme'] ?? 'light';

/* ADMIN STATS */
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$total_tutors = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='tutor'")->fetch_assoc()['total'];
$total_students = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='student'")->fetch_assoc()['total'];
$total_courses = $conn->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
$total_reviews = $conn->query("SELECT COUNT(*) AS total FROM reviews")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Profile • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/admin_pro.css">
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

    <div class="admin-container">

        <!-- LEFT SIDEBAR -->
        <div class="admin-left">

            <div class="admin-card profile-card">
                <img src="<?= $user['avatar'] 
                    ? $BASE_URL . '/uploads/' . $user['avatar'] 
                    : $BASE_URL . '/images/default-avatar.png' ?>" 
                    class="admin-avatar">

                <h3><?= htmlspecialchars($user['name']) ?></h3>
                <p class="role-badge">Administrator</p>

                <form action="../toggle_theme.php" method="POST">
                    <button class="theme-btn">
                        <i class="fa-solid fa-circle-half-stroke"></i>
                        Switch to <?= ($theme === 'light') ? 'Dark' : 'Light' ?> Mode
                    </button>
                </form>
            </div>

            <div class="admin-card">
                <h3>Quick Actions</h3>

                <a href="manage_users.php" class="admin-btn">
                    <i class="fa-solid fa-users-gear"></i> Manage Users
                </a>

                <a href="manage_users.php" class="admin-btn">
                    <i class="fa-solid fa-book"></i> Manage Courses
                </a>

                <a href="site_settings.php" class="admin-btn">
                    <i class="fa-solid fa-gear"></i> Site Settings
                </a>

                <a href="<?= $BASE_URL ?>/logout.php" class="admin-btn logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>

        </div>

        <!-- RIGHT CONTENT -->
        <div class="admin-right">

            <div class="admin-card">
                <h3>Platform Overview</h3>

                <div class="admin-stats-grid">

                    <div class="stat-box">
                        <i class="fa-solid fa-users"></i>
                        <h4><?= $total_users ?></h4>
                        <p>Total Users</p>
                    </div>

                    <div class="stat-box">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <h4><?= $total_tutors ?></h4>
                        <p>Tutors</p>
                    </div>

                    <div class="stat-box">
                        <i class="fa-solid fa-user-graduate"></i>
                        <h4><?= $total_students ?></h4>
                        <p>Students</p>
                    </div>

                    <div class="stat-box">
                        <i class="fa-solid fa-book-open"></i>
                        <h4><?= $total_courses ?></h4>
                        <p>Courses</p>
                    </div>

                    <div class="stat-box">
                        <i class="fa-solid fa-star"></i>
                        <h4><?= $total_reviews ?></h4>
                        <p>Reviews</p>
                    </div>

                </div>
            </div>

            <div class="admin-card">
                <h3>System Logs</h3>
                <p>Coming soon…</p>
            </div>

        </div>

    </div>

<?php include "../includes/footer.php"; ?>
<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>
