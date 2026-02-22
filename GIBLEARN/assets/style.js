function openMenu() {
    document.getElementById("mobileMenu").style.width = "100%";
}

function closeMenu() {
    document.getElementById("mobileMenu").style.width = "0%";
}

//filter logic for resources page
const buttons = document.querySelectorAll(".cat-btn");
const cards = document.querySelectorAll(".resource-card");

buttons.forEach(btn => {
    btn.addEventListener("click", () => {

        // Remove active class from all buttons
        buttons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        const filter = btn.getAttribute("data-filter");

        cards.forEach(card => {
            const category = card.getAttribute("data-category");

            if (filter === "all" || filter === category) {
                card.style.display = "block";
                card.style.opacity = "1";
            } else {
                card.style.display = "none";
                card.style.opacity = "0";
            }
        });
    });
});

// Sticky Header Script
window.addEventListener("scroll", function () {
    const header = document.querySelector("header");

    if (window.scrollY > 20) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
});
