document.addEventListener('DOMContentLoaded', function () {
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach((slide) => slide.style.display = 'none');
        slides[index].style.display = 'block';
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    }

    setInterval(nextSlide, 5000); // Změňte interval podle potřeby
    showSlide(currentIndex);
});

function toggleMenuButton() {
    var menuButton = document.querySelector('.menu-btn');
    var menu = document.querySelector('.menu');

    if (window.innerWidth <= 768) {
        menuButton.style.display = 'block';
        menu.style.display = 'none';
    } else {
        menuButton.style.display = 'none';
        menu.style.display = 'flex';
    }
}

function toggleMenu() {
    var menu = document.querySelector('.menu');
    menu.style.display = (menu.style.display === 'flex' || menu.style.display === '') ? 'none' : 'flex';
}


toggleMenuButton();
window.addEventListener('resize', toggleMenuButton);
