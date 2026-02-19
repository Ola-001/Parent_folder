<?php
session_start();
include "/includes/db.php";

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit("Not logged in");
}

if (!isset($_POST['id'])) {
    http_response_code(400);
    exit("Missing ID");
}

$notif_id   = (int)$_POST['id'];
$student_id = (int)$_SESSION['user_id'];

$sql = "UPDATE notifications 
        SET is_read = 1 
        WHERE id = ? AND student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $notif_id, $student_id);
$stmt->execute();

echo "OK";
