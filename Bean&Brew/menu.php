<?php
session_start();
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Menu • Beans & Brew</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "header.php"; ?>

<section class="page-hero">
    <h1>Our Menu</h1>
    <p>Crafted drinks & freshly baked treats</p>
</section>

<section class="menu-grid">

    <!-- Espresso -->
    <div class="product-card">
        <img src="img/Espresso.jpg" alt="Espresso">
        <h3>Espresso</h3>
        <p class="category">Beverage</p>
        <p class="price">£2.50</p>
        <button class="add-to-cart"
                data-id="16"
                data-name="Espresso"
                data-price="2.50"
                data-image="img/Espresso.jpg">
            Add to Cart
        </button>
    </div>

    <!-- Cappuccino -->
    <div class="product-card">
        <img src="img/Cappuccino.jpg" alt="Cappuccino">
        <h3>Cappuccino</h3>
        <p class="category">Beverage</p>
        <p class="price">£3.00</p>
        <button class="add-to-cart"
                data-id="17"
                data-name="Cappuccino"
                data-price="3.00"
                data-image="img/Cappuccino.jpg">
            Add to Cart
        </button>
    </div>

    <!-- Latte -->
    <div class="product-card">
        <img src="img/Latte.jpg" alt="Latte">
        <h3>Latte</h3>
        <p class="category">Beverage</p>
        <p class="price">£3.50</p>
        <button class="add-to-cart"
                data-id="18"
                data-name="Latte"
                data-price="3.50"
                data-image="img/Latte.jpg">
            Add to Cart
        </button>
    </div>

    <!-- Hot Chocolate -->
    <div class="product-card">
        <img src="img/Hot Chocolate.jpg" alt="Hot Chocolate">
        <h3>Hot Chocolate</h3>
        <p class="category">Beverage</p>
        <p class="price">£2.80</p>
        <button class="add-to-cart"
                data-id="19"
                data-name="Hot Chocolate"
                data-price="2.80"
                data-image="img/Hot Chocolate.jpg">
            Add to Cart
        </button>
    </div>

    <!-- Blueberry Muffin -->
    <div class="product-card">
        <img src="img/Blueberry Muffin.jpg" alt="Blueberry Muffin">
        <h3>Blueberry Muffin</h3>
        <p class="category">Pastry</p>
        <p class="price">£2.20</p>
        <button class="add-to-cart"
                data-id="20"
                data-name="Blueberry Muffin"
                data-price="2.20"
                data-image="img/Blueberry Muffin.jpg">
            Add to Cart
        </button>
    </div>

</section>

<?php include "footer.php"; ?>

</body>
</html>
