<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us • Beans & Brew</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "header.php"; ?>

<!-- HERO -->
    
    <section class="page-hero">
        <h1>Let's Connect</h1>
        <p>Your message matters — we're here to help</p>
    </section>

<!-- CONTACT SECTION -->
<section class="contact-wrapper">
    <div class="container contact-grid">

        <!-- LEFT: INFO -->
        <div class="contact-info-card">
            <h2>Reach Us</h2>
            <p class="info-subtext">We're always happy to hear from you.</p>

            <div class="info-item">
                <div>
                    <h4>Address</h4>
                    <p>123 Coffee Street, London, UK</p>
                </div>
            </div>

            <div class="info-item">
                <div>
                    <h4>Phone</h4>
                    <p>+44 123 456 7890</p>
                </div>
            </div>

            <div class="info-item">
                <div>
                    <h4>Email</h4>
                    <p>support@beansbrew.com</p>
                </div>
            </div>

            <div class="info-item">
                <div>
                    <h4>Hours</h4>
                    <p>Mon – Sat: 8:00 AM – 8:00 PM</p>
                </div>
            </div>
        </div>

        <!-- RIGHT: FORM -->
        <div class="contact-form-card">
            <h2>Send a Message</h2>

            <form action="#" method="POST">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Your Name" required>
                </div>

                <div class="input-group">
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>

                <div class="input-group">
                    <textarea name="message" placeholder="Your Message" required></textarea>
                </div>

                <button type="submit" class="contact-submit-btn">Send Message</button>

                <div id="message-success" class="message-success">
                    Your message has been sent successfully!
                </div>
            </form>
        </div>

    </div>
</section>

<?php include "footer.php"; ?>

</body>
</html>
