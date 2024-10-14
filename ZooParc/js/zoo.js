
document.addEventListener('DOMContentLoaded', () => {

    // Get the menu button and navigation menu
    const menuBtn = document.querySelector(".menu-btn");
    const navigation = document.querySelector(".navigation");

    // active class on menu button and navigation when clicked
    menuBtn.addEventListener("click", () => {
        menuBtn.classList.toggle("active");
        navigation.classList.toggle("active");
    });

    // Get navigation buttons
    const btns = document.querySelectorAll(".nav-btn");
    const slides = document.querySelectorAll(".img-slide");
    const contents = document.querySelectorAll(".content");

    // change the slide manually
    const sliderNav = function(manual) {

        btns.forEach((btn) => btn.classList.remove("active"));
        slides.forEach((slide) => slide.classList.remove("active"));
        contents.forEach((content) => content.classList.remove("active"));

        btns[manual].classList.add("active");
        slides[manual].classList.add("active");
        contents[manual].classList.add("active");
    }

    // click event to each navigation button
    btns.forEach((btn, i) => {
        btn.addEventListener("click", () => {
            sliderNav(i); 
        });
    });

    // Start with the first slide
    let currentSlide = 0;

    // Automatically switch to the next slide
    function autoSlide() {
        currentSlide = (currentSlide + 1) % btns.length; 
        sliderNav(currentSlide); 
    }

    // Change slides time
    setInterval(autoSlide, 5000); 
});
