<?php
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    unset($_SESSION['cart'][$id]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex
}

header("Location: cart.php");
exit;
?>
