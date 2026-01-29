// ===================== FORM CARD ANIMATION =====================
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".form-card").forEach((card, i) => {
    setTimeout(() => {
      card.style.opacity = 1;
      card.style.transform = "translateY(0)";
    }, i * 200);
  });
});

// ===================== PRODUCT CARD HOVER EFFECT =====================
document.querySelectorAll(".product-card").forEach((card) => {
  card.addEventListener("mouseenter", () => {
    card.style.transform = "scale(1.05)";
    card.style.boxShadow = "0 8px 16px rgba(0, 0, 0, 0.2)";
  });
  card.addEventListener("mouseleave", () => {
    card.style.transform = "scale(1)";
    card.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.1)";
  });
});

// ===================== ADD TO CART FUNCTION =====================
document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", function () {

        let name = this.dataset.name;
        let price = this.dataset.price;
        let image = this.dataset.image; // NEW: image support

        fetch("add_to_cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `name=${encodeURIComponent(name)}&price=${price}&image=${encodeURIComponent(image)}`
        })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === "success") {
                alert(name + " added to cart!");

                // LIVE CART COUNT UPDATE
                let cartCount = document.getElementById("cart-count");
                if (cartCount) {
                    cartCount.textContent = parseInt(cartCount.textContent) + 1;
                }
            }
        });
    });
});

// ===================== CONTACT FORM SUCCESS FEEDBACK =====================
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("contactForm");
    const successBox = document.getElementById("message-success");

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();

            successBox.classList.add("show");
            form.reset();

            setTimeout(() => {
                successBox.classList.remove("show");
            }, 4000);
        });
    }
});

function openNav() {
    document.getElementById("mobileOverlay").style.height = "100%";
}

function closeNav() {
    document.getElementById("mobileOverlay").style.height = "0%";
}
