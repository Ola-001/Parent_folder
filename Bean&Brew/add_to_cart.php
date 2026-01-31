<?php
session_start();
include __DIR__ . "/db.php"; // ensures correct path even with & in folder name

// Create cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get product data from POST
$id     = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name   = isset($_POST['name']) ? $_POST['name'] : '';
$price  = isset($_POST['price']) ? floatval($_POST['price']) : 0;
$image  = isset($_POST['image']) ? $_POST['image'] : '';

// Validate
if ($id > 0 && $name !== '' && $price > 0) {

    // Check if item already exists in cart (by ID)
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $id) {
            $item['quantity']++;

            // Log activity (if user logged in)
            if (isset($_SESSION['user_id'])) {
                $uid = $_SESSION['user_id'];
                $action = "Added to cart";
                $details = $name . " (ID: $id)";
                $log = $conn->prepare("INSERT INTO user_activity (user_id, action, details) VALUES (?, ?, ?)");
                $log->bind_param("iss", $uid, $action, $details);
                $log->execute();
            }

            echo "success";
            exit;
        }
    }

    // Add new item
    $_SESSION['cart'][] = [
        'id'       => $id,
        'name'     => $name,
        'price'    => $price,
        'quantity' => 1,
        'image'    => $image
    ];

    // Log activity (if user logged in)
    if (isset($_SESSION['user_id'])) {
        $uid = $_SESSION['user_id'];
        $action = "Added to cart";
        $details = $name . " (ID: $id)";
        $log = $conn->prepare("INSERT INTO user_activity (user_id, action, details) VALUES (?, ?, ?)");
        $log->bind_param("iss", $uid, $action, $details);
        $log->execute();
    }

    echo "success";
    exit;
}

echo "error";
?>
