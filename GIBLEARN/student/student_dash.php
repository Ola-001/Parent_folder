<?php
session_start();
include "../includes/db.php";   // FIXED
$BASE_URL = "/Parent_folder/GIBLEARN";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit; 
}

$student_id = $_SESSION['user_id'];

/* ========== STUDENT INFO ========== */
$stmt = $conn->prepare("SELECT name, avatar FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$student_name   = $student['name']   ?? 'Student';
$student_avatar = "$BASE_URL/images/default-avatar.png";

/* ========== HOURS STUDIED (THIS WEEK) ========== */
$sql = "SELECT COALESCE(SUM(minutes_studied),0) AS total_minutes
        FROM study_sessions
        WHERE student_id = ?
        AND YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();
$hours_week = round(($res['total_minutes'] ?? 0) / 60, 1);

/* ========== LESSONS COMPLETED ========== */
$sql = "SELECT COUNT(*) AS lessons_completed
        FROM lesson_progress
        WHERE student_id = ? AND is_completed = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();
$lessons_completed = $res['lessons_completed'] ?? 0;

/* ========== STREAK (DAYS IN A ROW) ========== */
$sql = "SELECT DISTINCT date
        FROM study_sessions
        WHERE student_id = ?
        ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$streak   = 0;
$expected = new DateTime(); // today
while ($row = $result->fetch_assoc()) {
    $d = new DateTime($row['date']);
    if ($d->format('Y-m-d') === $expected->format('Y-m-d')) {
        $streak++;
        $expected->modify('-1 day');
    } else {
        break;
    }
}

/* ========== BADGES ========== */
$sql = "SELECT b.name, b.icon
        FROM student_badges sb
        JOIN badges b ON sb.badge_id = b.id
        WHERE sb.student_id = ?
        ORDER BY sb.earned_at DESC
        LIMIT 6";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$badges = $stmt->get_result();

/* ========== NOTIFICATIONS ========== */
$sql = "SELECT id, message, is_read, created_at
        FROM notifications
        WHERE student_id = ?
        ORDER BY created_at DESC
        LIMIT 10";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$notifications = $stmt->get_result();

$unread_count = 0;
$notifications->data_seek(0);
while ($row = $notifications->fetch_assoc()) {
    if (!$row['is_read']) $unread_count++;
}
$notifications->data_seek(0);

/* ========== ENROLLED COURSES ========== */
$sql = "SELECT c.id, c.title, c.thumbnail,
        COALESCE(cp.progress_percent, 0) AS progress
        FROM enrollments e
        JOIN courses c ON e.course_id = c.id
        LEFT JOIN lesson_progress lp 
            ON lp.student_id = e.student_id AND lp.module_id IN (
                SELECT id FROM modules WHERE course_id = c.id
            )
        LEFT JOIN (
            SELECT student_id, course_id,
                   ROUND( (SUM(is_completed) / COUNT(*)) * 100 ) AS progress_percent
            FROM lesson_progress lp2
            JOIN modules m2 ON lp2.module_id = m2.id
            GROUP BY student_id, course_id
        ) cp ON cp.student_id = e.student_id AND cp.course_id = c.id
        WHERE e.student_id = ?
        GROUP BY c.id";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$courses = $stmt->get_result();

/* ========== SAVED RESOURCES ========== */
$sql = "SELECT title, resource_type, url
        FROM saved_resources
        WHERE student_id = ?
        ORDER BY created_at DESC
        LIMIT 6";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$saved_resources = $stmt->get_result();

/* ========== WEEKLY HOURS FOR CHART ========== */
$weekly_data = [];
$sql = "SELECT DATE(date) AS d, SUM(minutes_studied) AS mins
        FROM study_sessions
        WHERE student_id = ?
        AND date >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        GROUP BY DATE(date)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $weekly_data[$row['d']] = round($row['mins'] / 60, 1);
}

$labels = [];
$values = [];
for ($i = 6; $i >= 0; $i--) {
    $d = (new DateTime())->modify("-$i day")->format('Y-m-d');
    $labels[] = $d;
    $values[] = $weekly_data[$d] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Dashboard • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/student_dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include "../includes/header.php"; ?>

<div class="dash-wrapper">

    <!-- HERO WITH FULL IMAGE BANNER -->
    <section class="dash-hero">
        <div class="dash-hero-bg">
            <img src="<?= $BASE_URL ?>/images/about.jpg" alt="Dashboard Hero">
            <div class="dash-hero-overlay"></div>
        </div>

        <div class="dash-hero-content">
            <div class="dash-hero-left">
                <img src="<?= htmlspecialchars($student_avatar) ?>" class="dash-avatar" alt="student">
                <div>
                    <h1>Welcome back, <?= htmlspecialchars($student_name) ?> 👋</h1>
                    <p>You’ve studied <strong><?= $hours_week ?></strong> hours this week. Keep going.</p>
                </div>
            </div>
            <div class="dash-hero-right">
                <span class="streak-pill">
                    <i class="fa-solid fa-fire"></i>
                    <?= $streak ?>‑day streak
                </span>
                <span class="notif-pill">
                    <i class="fa-solid fa-bell"></i>
                    <?= $unread_count ?> new notifications
                </span>
            </div>
        </div>
    </section>

    <!-- STATS ROW -->
    <section class="dash-stats">
        <div class="stat-card">
            <i class="fa-solid fa-clock"></i>
            <h3><?= $hours_week ?></h3>
            <p>Hours studied (this week)</p>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-book-open"></i>
            <h3><?= $lessons_completed ?></h3>
            <p>Lessons completed</p>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-fire"></i>
            <h3><?= $streak ?></h3>
            <p>Day streak</p>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-medal"></i>
            <h3><?= $badges->num_rows ?></h3>
            <p>Badges earned</p>
        </div>
    </section>

    <!-- MAIN TWO-COLUMN LAYOUT -->
    <section class="dash-main">
        <div class="dash-left">

            <!-- ENROLLED COURSES -->
            <div class="dash-card">
                <div class="dash-card-header">
                    <h2>Enrolled Courses</h2>
                    <a href="<?= $BASE_URL ?>/student/course.php" class="link-small">View all</a>
                </div>
                <div class="course-list">
                    <?php if ($courses->num_rows === 0): ?>
                        <p>You’re not enrolled in any courses yet.</p>
                    <?php else: ?>
                        <?php while ($c = $courses->fetch_assoc()): ?>
                            <div class="course-item">
                                <img src="<?= htmlspecialchars($c['thumbnail'] ?? "$BASE_URL/images/course-placeholder.jpg") ?>" alt="" class="course-thumb">
                                <div class="course-info">
                                    <h3><?= htmlspecialchars($c['title']) ?></h3>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: <?= (int)$c['progress'] ?>%;"></div>
                                    </div>
                                    <span class="progress-label"><?= (int)$c['progress'] ?>% complete</span>
                                </div>
                                <a href="<?= $BASE_URL ?>/student/course_view.php?id=<?= (int)$c['id'] ?>" class="btn-small">Continue</a>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- SAVED RESOURCES -->
            <div class="dash-card">
                <div class="dash-card-header">
                    <h2>Saved Resources</h2>
                </div>
                <div class="resource-list">
                    <?php if ($saved_resources->num_rows === 0): ?>
                        <p>No saved resources yet.</p>
                    <?php else: ?>
                        <?php while ($r = $saved_resources->fetch_assoc()): ?>
                            <div class="resource-item">
                                <div>
                                    <span class="resource-type"><?= strtoupper(htmlspecialchars($r['resource_type'])) ?></span>
                                    <h4><?= htmlspecialchars($r['title']) ?></h4>
                                </div>
                                <a href="<?= htmlspecialchars($r['url']) ?>" class="link-small" target="_blank">Open</a>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <div class="dash-right">

            <!-- WEEKLY HOURS CHART -->
            <div class="dash-card">
                <div class="dash-card-header">
                    <h2>Weekly Study Time</h2>
                </div>
                <canvas id="hoursChart"></canvas>
            </div>

            <!-- NOTIFICATIONS -->
            <div class="dash-card">
                <div class="dash-card-header">
                    <h2>Notifications</h2>
                </div>
                <?php if ($notifications->num_rows === 0): ?>
                    <p>No notifications yet.</p>
                <?php else: ?>
                    <ul class="notif-list">
                        <?php while ($n = $notifications->fetch_assoc()): ?>
                            <li class="notif-item <?= $n['is_read'] ? 'read' : 'unread' ?>" data-id="<?= $n['id'] ?>">
                                <p><?= htmlspecialchars($n['message']) ?></p>
                                <span class="notif-time"><?= date("M j, H:i", strtotime($n['created_at'])) ?></span>
                                <?php if (!$n['is_read']): ?>
                                    <button class="mark-read-btn" data-id="<?= $n['id'] ?>">Mark as read</button>
                                <?php endif; ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- BADGES -->
            <div class="dash-card">
                <div class="dash-card-header">
                    <h2>Badges</h2>
                </div>
                <div class="badge-grid">
                    <?php if ($badges->num_rows === 0): ?>
                        <p>No badges earned yet.</p>
                    <?php else: ?>
                        <?php while ($b = $badges->fetch_assoc()): ?>
                            <div class="badge-item">
                                <i class="<?= htmlspecialchars($b['icon']) ?>"></i>
                                <span><?= htmlspecialchars($b['name']) ?></span>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>

</div>

<script>
const ctx = document.getElementById('hoursChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Hours studied',
            data: <?= json_encode($values) ?>,
            backgroundColor: '#ff914d'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});

document.querySelectorAll(".mark-read-btn").forEach(btn => {
    btn.addEventListener("click", function() {
        const id = this.dataset.id;
        fetch("<?= $BASE_URL ?>/messaging/mark_notification.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "id=" + encodeURIComponent(id)
        })
        .then(res => res.text())
        .then(data => {
            if (data === "OK") {
                const li = this.closest(".notif-item");
                li.classList.remove("unread");
                li.classList.add("read");
                this.remove();
            }
        });
    });
});
</script>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>
