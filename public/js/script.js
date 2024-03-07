// Toogle class active
const navbarNav = document.querySelector(".navbar-nav");

// ketika wedding-menu di klik
document.querySelector("#wedding-menu").onclick = () => {
    navbarNav.classList.toggle("active");
};

// klik di luar sidebar untuk menghilangkan nav
const wedding = document.querySelector("#wedding-menu");

document.addEventListener("click", function (e) {
    if (!wedding.contains(e.target) && !navbarNav.contains(e.target)) {
        navbarNav.classList.remove("active");
    }
});

// Dapatkan tombol kembali ke atas
var scrollToTopButton = document.getElementById("scrollToTopButton");

// Tambahkan event listener untuk mengatur kapan tombol ditampilkan atau disembunyikan
window.addEventListener("scroll", function () {
    if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
    ) {
        scrollToTopButton.style.display = "block";
    } else {
        scrollToTopButton.style.display = "none";
    }
});

var scrollToTopButton = document.getElementById("scrollToTopButton");

window.addEventListener("scroll", function () {
    if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
    ) {
        scrollToTopButton.style.display = "block";
    } else {
        scrollToTopButton.style.display = "none";
    }
});

scrollToTopButton.addEventListener("click", function () {
    document.body.scrollTop = 0; // Untuk browser yang tidak mendukung Element.scrollTop
    document.documentElement.scrollTop = 0; // Untuk browser yang mendukung Element.scrollTop
});
