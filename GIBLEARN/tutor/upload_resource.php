<?php
session_start();
$BASE_URL = "/Parent_folder/GIBLEARN";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Resources • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/tutor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php include "../includes/header.php"; ?>

<div class="tutor-dashboard">

    <h2 class="dash-title"><i class="fa-solid fa-upload"></i> Upload Course Resources</h2>

    <form class="course-form">

        <label>Select Course</label>
        <select>
            <option>Web Development Basics</option>
            <option>Introduction to Python</option>
            <option>UI/UX Design for Beginners</option>
        </select>

        <label>Upload File</label>
        <input type="file">

        <label>Resource Type</label>
        <select>
            <option>PDF Document</option>
            <option>Video File</option>
            <option>Image</option>
            <option>ZIP Folder</option>
        </select>

        <button class="submit-btn">Upload Resource</button>

    </form>

</div>

<?php include "../includes/footer.php"; ?>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>
