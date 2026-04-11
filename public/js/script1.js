document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("mobile-menu");
    if (btn) {
        btn.addEventListener("click", function () {
            menu.classList.toggle("hidden");
        });
    }
});


const srEls = document.querySelectorAll('.sr');
const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
    });
}, { threshold: 0.1 });
srEls.forEach(el => io.observe(el));
