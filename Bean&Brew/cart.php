<?php
session_start();
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Your Cart • Beans & Brew</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "header.php"; ?>

<section class="page-hero">
  <h1>Your Cart</h1>
</section>

<section class="cart-container">

<?php if (empty($_SESSION['cart'])): ?>
    <p>Your cart is empty.</p>

<?php else: ?>

    <?php
    $total = 0;
    foreach ($_SESSION['cart'] as $index => $item):
        $itemTotal = $item['price'] * $item['quantity'];
        $total += $itemTotal;
    ?>
    
    <div class="cart-item">

        <!-- Product Image -->
        <?php if (!empty($item['image'])): ?>
            <img src="<?= $item['image'] ?>" class="cart-img">
        <?php endif; ?>

        <!-- Product Info -->
        <div class="cart-info">
            <h3><?= htmlspecialchars($item['name']) ?></h3>
            <p>£<?= number_format($item['price'], 2) ?></p>
            <p>Quantity: <?= $item['quantity'] ?></p>

            <span>Qty: <?= $item['quantity'] ?></span>
        </div>

        <!-- Remove Button -->
        <form method="POST" action="remove_item.php">
            <input type="hidden" name="id" value="<?= $index ?>">
            <button class="remove-btn">Remove</button>
        </form>

    </div>

    <?php endforeach; ?>

    <!-- Cart Total -->
    <div class="cart-total">
        <strong>Total:</strong>
        £<?= number_format($total, 2) ?>
    </div>

    <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>

<?php endif; ?>

</section>

<?php include "footer.php"; ?>

</body>
</html>
