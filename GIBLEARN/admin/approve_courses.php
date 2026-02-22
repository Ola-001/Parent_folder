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

/* APPROVE COURSE */
if (isset($_GET['approve'])) {
    $cid = intval($_GET['approve']);
    $conn->query("UPDATE courses SET status='published' WHERE id=$cid");
    header("Location: approve_courses.php");
    exit;
}

/* REJECT COURSE */
if (isset($_GET['reject'])) {
    $cid = intval($_GET['reject']);
    $conn->query("DELETE FROM courses WHERE id=$cid");
    header("Location: approve_courses.php");
    exit;
}

/* FETCH PENDING COURSES */
$sql = "SELECT c.id, c.title, c.thumbnail, c.created_at, u.name AS tutor_name
        FROM courses c
        JOIN users u ON c.tutor_id = u.id
        WHERE c.status='draft' OR c.status='pending'
        ORDER BY c.created_at DESC";

$courses = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Approve Courses • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/theme.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="<?= $theme ?>">

<?php include "../includes/header.php"; ?>

<div class="admin-container">

    <div class="admin-right" style="width:100%;">

        <div class="admin-card">
            <h3><i class="fa-solid fa-check"></i> Approve Courses</h3>

            <?php if ($courses->num_rows === 0): ?>
                <p>No courses awaiting approval.</p>
            <?php else: ?>

                <?php while ($c = $courses->fetch_assoc()): ?>
                    <div class="admin-card" style="margin-top:20px;">

                        <div style="display:flex; gap:20px; align-items:center;">

                            <img src="<?= $BASE_URL ?>/uploads/<?= $c['thumbnail'] ?>"
                                 style="width:120px; height:90px; object-fit:cover; border-radius:10px;">

                            <div style="flex:1;">
                                <h4><?= htmlspecialchars($c['title']) ?></h4>
                                <p>By: <?= htmlspecialchars($c['tutor_name']) ?></p>
                                <small>Submitted: <?= date("F j, Y", strtotime($c['created_at'])) ?></small>
                            </div>

                            <div style="display:flex; gap:10px;">
                                <a href="approve_courses.php?approve=<?= $c['id'] ?>" class="admin-btn" style="background:#28a745;">
                                    <i class="fa-solid fa-check"></i> Approve
                                </a>

                                <a href="approve_courses.php?reject=<?= $c['id'] ?>" class="admin-btn logout"
                                   onclick="return confirm('Reject and delete this course?');">
                                    <i class="fa-solid fa-xmark"></i> Reject
                                </a>
                            </div>

                        </div>

                    </div>
                <?php endwhile; ?>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php include "../includes/footer.php"; ?>
<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>
