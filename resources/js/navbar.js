document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("mobile-menu");

    if (btn) {
        btn.addEventListener("click", function () {
            menu.classList.toggle("hidden");
        });
    }
});
