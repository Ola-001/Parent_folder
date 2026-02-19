<?php
session_start();
include "../includes/db.php";
$BASE_URL = "/Parent_folder/GIBLEARN";

// Redirect if not logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

/* FETCH ENROLLED COURSES */
$sql = "SELECT c.id, c.title, c.thumbnail,
        COALESCE(cp.progress_percent, 0) AS progress
        FROM enrollments e
        JOIN courses c ON e.course_id = c.id
        LEFT JOIN (
            SELECT lp.student_id, m.course_id,
                   ROUND((SUM(lp.is_completed) / COUNT(*)) * 100) AS progress_percent
            FROM lesson_progress lp
            JOIN modules m ON lp.module_id = m.id
            GROUP BY lp.student_id, m.course_id
        ) cp ON cp.student_id = e.student_id AND cp.course_id = c.id
        WHERE e.student_id = ?
        GROUP BY c.id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$courses = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Courses • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/student_courses.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include "../includes/header.php"; ?>

<!-- HERO -->
<section class="courses-hero">
    <div class="courses-hero-bg">
        <img src="<?= $BASE_URL ?>/images/about.jpg">
        <div class="courses-hero-overlay"></div>
    </div>

    <div class="courses-hero-content">
        <h1>Your Courses</h1>
        <p>Continue learning and track your progress.</p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="courses-wrapper">

    <?php if ($courses->num_rows === 0): ?>
        <div class="no-courses">
            <i class="fa-solid fa-book-open"></i>
            <h2>No Courses Yet</h2>
            <p>You haven’t enrolled in any courses.</p>
        </div>
    <?php else: ?>

        <div class="courses-grid">
            <?php while ($c = $courses->fetch_assoc()): ?>
                <div class="course-card">

                    <img src="<?= htmlspecialchars($c['thumbnail'] ?? "$BASE_URL/images/course-placeholder.jpg") ?>" 
                         class="course-thumb">

                    <div class="course-info">
                        <h3><?= htmlspecialchars($c['title']) ?></h3>

                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?= (int)$c['progress'] ?>%;"></div>
                        </div>

                        <span class="progress-label"><?= (int)$c['progress'] ?>% complete</span>

                        <a href="<?= $BASE_URL ?>/student/course_view.php?id=<?= (int)$c['id'] ?>" 
                           class="course-btn">Continue</a>
                    </div>

                </div>
            <?php endwhile; ?>
        </div>

    <?php endif; ?>

</div>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>
