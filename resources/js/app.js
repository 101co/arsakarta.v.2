import './bootstrap';
import 'flowbite';
import gsap from 'gsap';

// Hide preloader and show content after a delay (1000 ms or 1 second)
window.addEventListener('load', function () {
    setTimeout(function () {
        document.getElementById('preloader').style.display = 'none'; // Hide loader
        document.getElementById('content').style.display = 'block';  // Show page content
    }, 500); // 1000 ms = 1 second delay
});

document.addEventListener('livewire:init', () => {
  console.log('heree');
  
  gsap.from(".animation-title", { opacity: 0, y: -50, duration: 2 });
})

document.addEventListener('DOMContentLoaded', function () {
    /* touch scroll hero */
    const carouselElement = document.getElementById('indicators-carousel');
    let startX = 0;
    let endX = 0;
  
    // Detect when the user starts touching the screen
    carouselElement.addEventListener('touchstart', function (e) {
      startX = e.touches[0].clientX;
    });
  
    // Detect when the user moves their finger
    carouselElement.addEventListener('touchmove', function (e) {
      endX = e.touches[0].clientX;
    });
  
    // Detect when the user lifts their finger
    carouselElement.addEventListener('touchend', function () {
      const diffX = startX - endX;
  
      // If swipe is significant, navigate the carousel
      if (Math.abs(diffX) > 50) {
        if (diffX > 0) {
          // Swipe left, show the next slide
          document.querySelector('[data-carousel-next]').click();
        } else {
          // Swipe right, show the previous slide
          document.querySelector('[data-carousel-prev]').click();
        }
      }
    });
});