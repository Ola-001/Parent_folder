<?php
    include "db.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beans & Brew • Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ===================== HEADER ===================== -->
<header>
    <div class="nav-container">

        <!-- Logo -->
        <div class="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="Beans & Brew Logo">
            </a>
            <span>Beans & Brew</span>
        </div>

        <!-- Desktop Navigation -->
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
        </nav>

        <!-- User Actions -->
        <div class="user-actions">
            <a href="login.php" class="btn">Login</a>
            <a href="signup.php" class="btn">Sign Up</a>
        </div>

        <!-- Hamburger -->
        <span class="hamburger-icon" onclick="openNav()">&#9776;</span>

    </div>
</header>

<!-- ===================== MOBILE OVERLAY MENU ===================== -->
<div id="mobileOverlay" class="overlay-menu">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

    <div class="overlay-content">
        <a href="index.php" onclick="closeNav()">Home</a>
        <a href="menu.php" onclick="closeNav()">Menu</a>
        <a href="about.php" onclick="closeNav()">About Us</a>
        <a href="contact.php" onclick="closeNav()">Contact</a>
        <a href="login.php" onclick="closeNav()">Login</a>
        <a href="signup.php" onclick="closeNav()">Sign Up</a>
    </div>
</div>

<!-- ===================== HERO ===================== -->
<section class="page-hero">
    <h1>Welcome to Beans & Brew</h1>
    <p>Fresh coffee. Warm moments. Crafted with love.</p>
</section>

<!-- ===================== FEATURED PRODUCTS ===================== -->
<section class="featured-products">
    <h2>Featured Products</h2>

    <div class="products-container">
        <div class="product-card">
            <img src="img/Espresso.jpg" alt="Espresso">
            <h3>Espresso</h3>
            <p class="price">£2.50</p>
        </div>

        <div class="product-card">
            <img src="img/Cappuccino.jpg" alt="Cappuccino">
            <h3>Cappuccino</h3>
            <p class="price">£3.00</p>
        </div>

        <div class="product-card">
            <img src="img/Latte.jpg" alt="Latte">
            <h3>Latte</h3>
            <p class="price">£3.50</p>
        </div>
    </div>
</section>

<!-- ===================== FOOTER ===================== -->
<?php include "footer.php"; ?>

<!-- ===================== JS ===================== -->
<script>
function openNav() {
    document.getElementById("mobileOverlay").style.height = "100%";
    document.body.style.overflow = "hidden";
}

function closeNav() {
    document.getElementById("mobileOverlay").style.height = "0%";
    document.body.style.overflow = "auto";
}
</script>

</body>
</html>
