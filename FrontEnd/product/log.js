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

 // change the slogan
 function changeSlogan() {
    var slogans = [
        "Good morning! Indulge in Digital Delights at Caféto Corner",
        "Your Virtual Café Escape: Login to Caféto's Flavorful Realm",
        "From Beans to Bytes: Sign in and Dive into Caféto's World"
    ];
    var sloganElement = document.getElementById("slogan");
    var currentSloganIndex = 0;

    setInterval(function() {
        sloganElement.innerText = slogans[currentSloganIndex];
        currentSloganIndex = (currentSloganIndex + 1) % slogans.length;
    }, 6000); 
}


changeSlogan();