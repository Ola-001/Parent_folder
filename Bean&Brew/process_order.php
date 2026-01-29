<?php
session_start();

// Only handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $payment = trim($_POST['payment'] ?? '');

    if ($name === '' || $email === '' || $address === '' || $payment === '') {
        echo "<h2>Missing information</h2>";
        echo "<p>Please fill in all fields.</p>";
        exit;
    }

    // Clear cart after order
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Successful • Beans & Brew</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: #faf4ec;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            padding: 20px;
        }

        .success-card {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            max-width: 450px;
            width: 100%;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            animation: fadeUp 0.7s ease forwards;
        }

        .success-icon {
            font-size: 4rem;
            color: #2ecc71;
            margin-bottom: 15px;
        }

        .success-card h2 {
            font-size: 2rem;
            color: #2f1b0c;
            margin-bottom: 10px;
        }

        .success-card p {
            color: #555;
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .success-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background: #c59d5f;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .success-btn:hover {
            background: #a66a3a;
            transform: translateY(-2px);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<div class="success-card">
    <div class="success-icon">✔</div>

    <h2>Order Placed Successfully!</h2>

    <p>Thank you, <strong><?= htmlspecialchars($name) ?></strong>.</p>
    <p>A confirmation has been sent to <strong><?= htmlspecialchars($email) ?></strong>.</p>
    <p>Your order will be delivered to:</p>
    <p><strong><?= nl2br(htmlspecialchars($address)) ?></strong></p>

    <a href="index.php" class="success-btn">Return Home</a>
</div>

</body>
</html>
