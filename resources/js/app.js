import './bootstrap';
import 'flowbite';
import ScrollReveal from 'scrollreveal';

/* scroll reveal plugin */
document.addEventListener('DOMContentLoaded', function () {
    /* title */
    ScrollReveal().reveal('.animation-title', {
        distance: '20px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'bottom',
        reset: true
    });
    ScrollReveal().reveal('.animation-title-sub', {
        distance: '20px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'bottom',
        delay: 200,
        reset: true
    });

    /* content */
    ScrollReveal().reveal('.animation-content-icon', {
        distance: '20px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'top',
        delay: 400,
        reset: true
    });
    ScrollReveal().reveal('.animation-content-title', {
        distance: '20px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'top',
        delay: 500,
        reset: true
    });
    ScrollReveal().reveal('.animation-content-title-sub', {
        distance: '20px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'top',
        delay: 600,
        reset: true
    });
    ScrollReveal().reveal('.animation-content', {
        distance: '20px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'top',
        delay: 700,
        reset: true
    });

    /* card */
    const sr = ScrollReveal({
        distance: '150px',
        duration: 1000,
        opacity: 0,   
        delay: 300,
        interval: 500,
        reset: true
    });

    /*  Mengatur reveal untuk semua card */
    sr.reveal('.animation-card-left', {
        origin: 'left',  // Card muncul dari bawah
    });

    /* hubungi admin */
    ScrollReveal().reveal('.animation-hubungi-admin-icon', {
        distance: '50px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'left',
        reset: true
    });
    ScrollReveal().reveal('.animation-hubungi-admin-title', {
        distance: '20px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'right',
        delay: 200,
        reset: true
    });
    ScrollReveal().reveal('.animation-hubungi-admin-title-sub', {
        distance: '20px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'right',
        delay: 300,
        reset: true
    });
    ScrollReveal().reveal('.animation-hubungi-admin-button', {
        distance: '20px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'right',
        delay: 400,
        reset: true
    });

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