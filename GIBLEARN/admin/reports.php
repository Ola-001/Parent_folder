<?php
session_start();
include "../includes/db.php";

$BASE_URL = "/Parent_folder/GIBLEARN";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* CHECK ADMIN ROLE */
$stmt = $conn->prepare("SELECT role, theme FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$theme = $user['theme'] ?? 'light';

/* STATS */
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$total_tutors = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='tutor'")->fetch_assoc()['total'];
$total_students = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='student'")->fetch_assoc()['total'];
$total_courses = $conn->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
$total_reviews = $conn->query("SELECT COUNT(*) AS total FROM reviews")->fetch_assoc()['total'];

/* RECENT USERS */
$recent_users = $conn->query("SELECT name, email, role, created_at FROM users ORDER BY created_at DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reports • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/theme.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/report.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="<?= $theme ?>">

<?php include "../includes/header.php"; ?>

<div class="admin-container">

    <div class="admin-right" style="width:100%;">

        <div class="admin-card">
            <h3><i class="fa-solid fa-chart-line"></i> Platform Reports</h3>

            <div class="admin-stats-grid">

                <div class="stat-box"><i class="fa-solid fa-users"></i><h4><?= $total_users ?></h4><p>Total Users</p></div>
                <div class="stat-box"><i class="fa-solid fa-chalkboard-user"></i><h4><?= $total_tutors ?></h4><p>Tutors</p></div>
                <div class="stat-box"><i class="fa-solid fa-user-graduate"></i><h4><?= $total_students ?></h4><p>Students</p></div>
                <div class="stat-box"><i class="fa-solid fa-book-open"></i><h4><?= $total_courses ?></h4><p>Courses</p></div>
                <div class="stat-box"><i class="fa-solid fa-star"></i><h4><?= $total_reviews ?></h4><p>Reviews</p></div>

            </div>
        </div>

        <div class="admin-card">
            <h3><i class="fa-solid fa-clock-rotate-left"></i> Recent Users</h3>

            <div class="recent-users-grid">
                <?php while ($u = $recent_users->fetch_assoc()): ?>
                    <div class="recent-user-item">
                        <div class="user-circle">
                            <?= strtoupper($u['name'][0]) ?>
                        </div>

                        <h4><?= htmlspecialchars($u['name']) ?></h4>
                        <span class="role-badge-small"><?= $u['role'] ?></span>

                        <p class="email"><?= htmlspecialchars($u['email']) ?></p>
                        <p class="joined">Joined: <?= date("F j, Y", strtotime($u['created_at'])) ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>


</div>

<?php include "../includes/footer.php"; ?>
<script src="<?= $BASE_URL ?>/assets/style.js"></script>
</body>
</html>
