<?php
include "db.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Checkout • Beans & Brew</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "header.php"; ?>

<section class="page-hero">
  <h1>Checkout</h1>
</section>

<section class="checkout">
    <div class="checkout-card">

        <h2>Complete Your Order</h2>

        <form class="checkout-form" method="POST" action="process_order.php">

            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Address</label>
                <textarea name="address" required></textarea>
            </div>

            <div class="input-group">
                <label>Payment Method</label>
                <select name="payment" required>
                    <option value="card">Credit/Debit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <button type="submit" class="checkout-submit">Place Order</button>

            <p class="secure-text">Your payment is secure and encrypted.</p>

        </form>

    </div>
</section>


<script src="js/style.js"></script>
<?php include "footer.php"; ?>




</body>
</html>
