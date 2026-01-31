<?php
session_start();
include __DIR__ . "/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];
$email = $_SESSION['user_email'];

// Fetch order history
$order_stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$order_stmt->bind_param("i", $user_id);
$order_stmt->execute();
$orders = $order_stmt->get_result();

// Fetch activity history
$activity_stmt = $conn->prepare("SELECT * FROM user_activity WHERE user_id = ? ORDER BY created_at DESC");
$activity_stmt->bind_param("i", $user_id);
$activity_stmt->execute();
$activities = $activity_stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "header.php"; ?>

<div class="profile-container">

    <div class="profile-header">
        <div class="profile-info">
            <h1><?= htmlspecialchars($name) ?></h1>
            <p><?= htmlspecialchars($email) ?></p>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <section class="section-block">
        <h2>Your Order History</h2>

        <?php if ($orders->num_rows === 0): ?>
            <p class="empty-text">You have not placed any orders yet.</p>
        <?php else: ?>
            <?php while ($order = $orders->fetch_assoc()): ?>
                <div class="order-card">
                    <div class="order-header">
                        <h3>Order #<?= $order['id'] ?></h3>
                        <span class="order-date"><?= $order['created_at'] ?></span>
                    </div>
                    <p class="order-total">Total: £<?= number_format($order['total'], 2) ?></p>

                    <h4>Items:</h4>
                    <ul class="item-list">
                        <?php
                        $item_stmt = $conn->prepare("
                            SELECT oi.quantity, oi.price, p.name 
                            FROM order_items oi
                            JOIN products p ON oi.product_id = p.id
                            WHERE oi.order_id = ?
                        ");
                        $item_stmt->bind_param("i", $order['id']);
                        $item_stmt->execute();
                        $items = $item_stmt->get_result();
                        while ($item = $items->fetch_assoc()):
                        ?>
                            <li>
                                <span><?= $item['quantity'] ?> × <?= htmlspecialchars($item['name']) ?></span>
                                <span>£<?= number_format($item['price'], 2) ?></span>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>

    <section class="section-block">
        <h2>Your Activity History</h2>

        <?php if ($activities->num_rows === 0): ?>
            <p class="empty-text">No recent activity.</p>
        <?php else: ?>
            <ul class="activity-list">
                <?php while ($act = $activities->fetch_assoc()): ?>
                    <li class="activity-item">
                        <div>
                            <strong><?= $act['action'] ?></strong>
                            <p><?= htmlspecialchars($act['details']) ?></p>
                        </div>
                        <em><?= $act['created_at'] ?></em>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </section>

</div>

<?php include "footer.php"; ?>

</body>
</html>
