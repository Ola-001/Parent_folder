<?php
session_start();
include "db.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $details = $_SESSION['cart'][$id]['name'] ?? 'Unknown item';

    unset($_SESSION['cart'][$id]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex
}

if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $action = "Removed from cart";
    
    $log = $conn->prepare("INSERT INTO user_activity (user_id, action, details) VALUES (?, ?, ?)");
    $log->bind_param("iss", $uid, $action, $details);
    $log->execute();
}

header("Location: cart.php");
exit;
?>
