<!DOCTYPE html>
<html lang="en">
<head>
  <title>About Us • Beans & Brew</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "header.php"; ?>

<!-- HERO SECTION -->
<section class="page-hero" style="background-image: url('img/coffee.jpg');">
  <h1>Crafting Moments, One Cup at a Time</h1>
  <p>Discover the story behind Beans & Brew</p>
</section>

<!-- ABOUT SECTION -->
<section class="about-section">
  <div class="container about-grid">

    <div class="about-text">
      <h2>Our Story</h2>
      <p>
        At Beans & Brew, every cup tells a story. What began as a small passion 
        project has grown into a warm, welcoming space where community, creativity, 
        and craftsmanship come together.
      </p>
      <p>
        We source ethically grown beans, roast with precision, and brew with care — 
        ensuring every sip is rich, smooth, and unforgettable.
      </p>

      <a href="menu.php" class="about-btn">Explore Our Menu</a>
    </div>

    <div class="about-image">
      <div class="image-frame">
        <img src="img/coffee shop.jpg" alt="Beans & Brew Coffee Shop">
      </div>
    </div>

  </div>
</section>

<!-- VALUES SECTION -->
<section class="values-section">
  <div class="container">
    <h2 class="values-title">What We Stand For</h2>

    <div class="values-grid">

      <div class="value-card">
        <div class="icon">☕</div>
        <h3>Quality</h3>
        <p>Premium beans, expert roasting, and precise brewing for unmatched flavor.</p>
      </div>

      <div class="value-card">
        <div class="icon">🌱</div>
        <h3>Sustainability</h3>
        <p>Eco‑friendly practices and ethically sourced ingredients in every cup.</p>
      </div>

      <div class="value-card">
        <div class="icon">🤝</div>
        <h3>Community</h3>
        <p>A space built for connection, creativity, and meaningful moments.</p>
      </div>

    </div>
  </div>
</section>

<!-- CALL TO ACTION -->
<section class="cta-section">
  <div class="cta-content">
    <h2>Visit Us & Experience the Difference</h2>
    <p>Your perfect cup is waiting.</p>
    <a href="contact.php" class="cta-btn">Get in Touch</a>
  </div>
</section>
<?php include "footer.php"; ?>

<script src="js/style.js"></script>
</body>
</html>
