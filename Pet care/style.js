/* ============================
   MOBILE MENU
============================ */

function openNav() {
    document.getElementById("mobileNav").style.width = "100%";
}

function closeNav() {
    document.getElementById("mobileNav").style.width = "0%";
}


/* ============================
   STICKY HEADER SHADOW
============================ */

const header = document.querySelector("header");

window.addEventListener("scroll", () => {
    header.classList.toggle("scrolled", window.scrollY > 50);
});


/* ============================
   SMOOTH SCROLLING
============================ */

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function (e) {
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({
                behavior: "smooth"
            });
        }
    });
});


/* ============================
   FADE-IN ANIMATIONS
============================ */

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
        }
    });
});

document.querySelectorAll(".service-card, .testimonial-box, .cta").forEach(el => {
    el.classList.add("hidden");
    observer.observe(el);
});


/* ============================
   BOOKING FORM LOGIC
============================ */

// Prevent selecting past dates
const dateInput = document.querySelector('input[type="date"]');
if (dateInput) {
    const today = new Date().toISOString().split("T")[0];
    dateInput.min = today;
}

// Fixed time slot dropdown
const timeSelect = document.getElementById("timeSelect");

// Disable past time slots for TODAY
if (dateInput && timeSelect) {
    dateInput.addEventListener("change", () => {
        const selectedDate = new Date(dateInput.value);
        const today = new Date();

        // Reset all options first
        Array.from(timeSelect.options).forEach(opt => opt.disabled = false);

        // If selected date is today
        if (selectedDate.toDateString() === today.toDateString()) {
            const currentHour = today.getHours();
            const currentMinutes = today.getMinutes();

            Array.from(timeSelect.options).forEach(option => {
                const timeText = option.textContent;
                if (!timeText.includes(":")) return;

                const [hour, minutePart] = timeText.split(":");
                const minute = minutePart.slice(0, 2);
                let hour24 = parseInt(hour);

                // Convert PM times
                if (timeText.includes("PM") && hour24 !== 12) hour24 += 12;
                if (timeText.includes("AM") && hour24 === 12) hour24 = 0;

                // Disable past times
                if (hour24 < currentHour || (hour24 === currentHour && minute < currentMinutes)) {
                    option.disabled = true;
                }
            });
        }
    });
}


/* ============================
   BOOKING CONFIRMATION
============================ */
function showConfirmation() {
    alert("🎉 Your appointment has been booked successfully!");
    window.location.href = "booking-success.html";
    return false; // prevent default form submission
}
