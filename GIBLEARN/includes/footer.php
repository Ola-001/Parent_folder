<?php 
$BASE_URL = "/Parent_folder/GIBLEARN";
?>

<footer class="footer">
    <div class="footer-container">

        <!-- LEFT: Logo + short text -->
        <div class="footer-section">
            <div class="logo">
            <a href="<?= $BASE_URL ?>/index.php">
                <img src="<?= $BASE_URL ?>/images/LOGO.png" alt="GIBLEARN Logo">
            </a>
        </div>
            <p class="footer-text">
                Empowering learners through personalised tutoring and accessible education.
            </p>
        </div>

        <!-- CENTER: Quick Links -->
        <div class="footer-section">
            <h3>Quick Links</h3>
            <a href="<?= $BASE_URL ?>/index.php">Home</a>
            <a href="<?= $BASE_URL ?>/about.php">How it works</a>
            <a href="<?= $BASE_URL ?>/resource.php">Resources</a>
            <a href="<?= $BASE_URL ?>/login.php">Login</a>
            <a href="<?= $BASE_URL ?>/register.php">Register</a>
        </div>

        <!-- SOCIAL ICONS -->
        <div class="footer-section">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                <a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
                <a href="https://www.youtube.com"><i class="fab fa-youtube"></i></a>
            </div>
        </div>


        <!-- RIGHT: Contact -->
        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email: support@giblearn.com</p>
            <p>Phone: +44 1234 567890</p>
            <p>Location: Gibraltar</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© <?= date("Y") ?> GibLearn. All rights reserved.</p>
    </div>
</footer>
