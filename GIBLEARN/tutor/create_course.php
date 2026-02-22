<?php
session_start();
include "../includes/db.php";

$BASE_URL = "/Parent_folder/GIBLEARN";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $level = trim($_POST['level']);
    $price = floatval($_POST['price']);
    $status = $_POST['status'];

    // Thumbnail Upload
    $thumbnail_name = null;

    if (!empty($_FILES['thumbnail']['name'])) {
        $upload_dir = "../uploads/";
        $thumbnail_name = time() . "_" . basename($_FILES['thumbnail']['name']);
        $target_file = $upload_dir . $thumbnail_name;

        move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file);
    }

    if (!empty($title) && !empty($description)) {

        $stmt = $conn->prepare("INSERT INTO courses 
            (tutor_id, title, description, thumbnail, price, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())");

        $stmt->bind_param("isssds",
            $user_id,
            $title,
            $description,
            $thumbnail_name,
            $price,
            $status
        );

        if ($stmt->execute()) {
            $success = "Course created successfully!";
        } else {
            $error = "Something went wrong.";
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Course • GibLearn</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/create_course.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php include "../includes/header.php"; ?>

<div class="create-container">

    <div class="create-card">

        <h2><i class="fa-solid fa-plus"></i> Create New Course</h2>

        <?php if ($success): ?>
            <div class="alert success"><?= $success ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label>Course Title *</label>
                <input type="text" name="title" required>
            </div>

            <div class="form-group">
                <label>Course Description *</label>
                <textarea name="description" rows="5" required></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category">
                        <option>Web Development</option>
                        <option>Programming</option>
                        <option>Design</option>
                        <option>Business</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Level</label>
                    <select name="level">
                        <option>Beginner</option>
                        <option>Intermediate</option>
                        <option>Advanced</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Price ($)</label>
                    <input type="number" name="price" step="0.01" value="0.00">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="draft">Draft</option>
                        <option value="published">Publish</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Thumbnail Image</label>
                <input type="file" name="thumbnail">
            </div>

            <button type="submit" class="submit-btn">
                <i class="fa-solid fa-check"></i> Create Course
            </button>

        </form>

    </div>

</div>

<?php include "../includes/footer.php"; ?>
<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>