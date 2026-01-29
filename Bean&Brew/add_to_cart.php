<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$name  = $_POST['name']  ?? '';
$price = floatval($_POST['price'] ?? 0);
$image = $_POST['image'] ?? ''; // optional

// Only process valid items
if ($name !== '' && $price > 0) {

    // Check if item already exists in cart
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $name) {
            $item['quantity']++;
            echo "success";
            exit;
        }
    }

    // Add new item
    $_SESSION['cart'][] = [
        'name'     => $name,
        'price'    => $price,
        'quantity' => 1,
        'image'    => $image
    ];
}

echo "success";
?>
