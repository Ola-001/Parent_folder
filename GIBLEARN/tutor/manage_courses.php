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

/* CHECK USER ROLE */
$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user['role'] !== 'tutor') {
    header("Location: ../index.php");
    exit;
}

/* DELETE COURSE */
if (isset($_GET['delete'])) {
    $course_id = intval($_GET['delete']);

    // Ensure tutor owns the course
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = ? AND tutor_id = ?");
    $stmt->bind_param("ii", $course_id, $user_id);
    $stmt->execute();

    header("Location: manage_courses.php");
    exit;
}

/* FETCH ALL TUTOR COURSES */
$sql = "SELECT c.id, c.title, c.thumbnail, c.price, c.created_at,
        (SELECT COUNT(*) FROM enrollments e WHERE e.course_id = c.id) AS total_students,
        (SELECT ROUND(AVG(r.rating),1) FROM reviews r WHERE r.course_id = c.id) AS avg_rating
        FROM courses c
        WHERE c.tutor_id = ?
        ORDER BY c.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$courses = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Courses • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/pro.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php include "../includes/header.php"; ?>

<div class="profile-container">

    <div style="width:100%;">

        <div class="profile-card">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <h3>Manage My Courses</h3>
                <a href="create_course.php" class="quick-btn">
                    <i class="fa-solid fa-plus"></i> Create New Course
                </a>
            </div>
        </div>

        <?php if ($courses->num_rows === 0): ?>
            <div class="profile-card">
                <p>You have not created any courses yet.</p>
            </div>
        <?php else: ?>

            <?php while ($course = $courses->fetch_assoc()): ?>
                <div class="profile-card">

                    <div style="display:flex; gap:20px; align-items:center; flex-wrap:wrap;">

                        <!-- Thumbnail -->
                        <img src="<?= htmlspecialchars($course['thumbnail'] ?? "$BASE_URL/images/course-placeholder.jpg") ?>"
                             style="width:120px; height:90px; object-fit:cover; border-radius:8px;">

                        <!-- Course Info -->
                        <div style="flex:1;">
                            <h4><?= htmlspecialchars($course['title']) ?></h4>

                            <p>
                                💰 $<?= number_format($course['price'], 2) ?> |
                                👨‍🎓 <?= $course['total_students'] ?> Students |
                                ⭐ <?= $course['avg_rating'] ?? "0.0" ?> Rating
                            </p>

                            <small>
                                Created: <?= date("F j, Y", strtotime($course['created_at'])) ?>
                            </small>
                        </div>

                        <!-- Actions -->
                        <div style="display:flex; gap:10px;">
                            <a href="edit_course.php?id=<?= $course['id'] ?>" class="quick-btn">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <a href="manage_courses.php?delete=<?= $course['id'] ?>"
                               class="quick-btn logout"
                               onclick="return confirm('Are you sure you want to delete this course?');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>

                    </div>

                </div>
            <?php endwhile; ?>

        <?php endif; ?>

    </div>

</div>

<?php include "../includes/footer.php"; ?>
<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>