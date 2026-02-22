<?php
session_start();
$BASE_URL = "/Parent_folder/GIBLEARN";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Analytics • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/tutor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php include "../includes/header.php"; ?>

<div class="tutor-dashboard">

    <h2 class="dash-title"><i class="fa-solid fa-chart-pie"></i> Analytics</h2>

    <div class="stats-grid">
        <div class="stat-card">
            <i class="fa-solid fa-eye"></i>
            <h3>Course Views</h3>
            <p>3,240</p>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-user-graduate"></i>
            <h3>Total Students</h3>
            <p>128</p>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-dollar-sign"></i>
            <h3>Total Earnings</h3>
            <p>$1,240</p>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-star"></i>
            <h3>Average Rating</h3>
            <p>4.8</p>
        </div>
    </div>

    <div class="chart-box">
        <h3>Monthly Student Growth</h3>
        <div class="chart-placeholder">Chart Placeholder</div>
    </div>

    <div class="chart-box">
        <h3>Earnings Overview</h3>
        <div class="chart-placeholder">Chart Placeholder</div>
    </div>

</div>

<?php include "../includes/footer.php"; ?>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>
