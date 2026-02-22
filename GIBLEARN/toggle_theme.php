<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get current theme
$stmt = $conn->prepare("SELECT theme FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$current = $stmt->get_result()->fetch_assoc()['theme'];

$new_theme = ($current === 'light') ? 'dark' : 'light';

// Update theme
$stmt = $conn->prepare("UPDATE users SET theme = ? WHERE id = ?");
$stmt->bind_param("si", $new_theme, $user_id);
$stmt->execute();

header("Location: " . $_SERVER['HTTP_REFERER']);

exit;
