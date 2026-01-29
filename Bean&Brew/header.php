<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header id="navbar">
    <div class="nav-container">

        <!-- Logo -->
        <a href="index.php" class="logo">
            <img src="img/logo.png" alt="Beans & Brew">
            <span>Beans & Brew</span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>

        <!-- User Actions -->
        <div class="user-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="profile.php" class="btn">Profile</a>
                <a href="logout.php" class="btn">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn">Login</a>
                <a href="signup.php" class="btn">Sign Up</a>
            <?php endif; ?>

            <!-- Cart -->
            <a href="cart.php" class="cart">
                <img src="img/cart.png" alt="Cart">
                <span class="cart-count" id="cart-count">
                    <?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0 ?>
                </span>
            </a>
        </div>

        <!-- Hamburger (Mobile Only) -->
        <span class="hamburger-icon" onclick="openNav()">&#9776;</span>

    </div>
</header>

<!-- FULLSCREEN OVERLAY MENU -->
<div id="mobileOverlay" class="overlay-menu">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

    <div class="overlay-content">
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        <?php endif; ?>

        <a href="cart.php">Cart (<?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0 ?>)</a>
    </div>
</div>

