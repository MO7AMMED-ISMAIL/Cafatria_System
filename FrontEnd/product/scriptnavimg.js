document.addEventListener('DOMContentLoaded', function() {
    var images = ["images/home-1-slider-image-3.jpg", "images/home-1-slider-image-1.jpg", "images/home-1-slider-image-2.jpg"]; 

    var index = 0;
    var mainhome = document.querySelector('.mainhome');

    //  change the background image
    function changeBackground() {
        mainhome.style.transition = "background-image 2s ease";
        mainhome.style.backgroundImage = "url('" + images[index] + "')";
        index = (index + 1) % images.length;
    }

    
    changeBackground();

   
    setInterval(changeBackground, 6000); 
});



// Nav Draw Toggle and Close
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('navToggle');
    const navClose = document.getElementById('navClose');
    const sideNav = document.getElementById('sideNav');

    navToggle.addEventListener('click', function() {
        sideNav.style.left = (sideNav.style.left === '0px') ? '-300px' : '0px';
    });

    navClose.addEventListener('click', function() {
        sideNav.style.left = '-300px';
    });
});



//sticky Navbar Scroll
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (window.pageYOffset >= 100) {
        navbar.classList.add('sticky');
        navbar.style.background="rgb(56, 45, 3)";
    } else {
        navbar.classList.remove('sticky');
        navbar.style.background="transparent";
    }
});