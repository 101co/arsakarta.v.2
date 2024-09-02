import './bootstrap';
import 'flowbite';

ScrollReveal({reset: true});
ScrollReveal().reveal('.heldef, .hel1, .hel2', { easing: 'ease-in', duration: 700, delay:300 });
// ScrollReveal({ distance: '10px' });
ScrollReveal().reveal('.ornament-behav-left', {easing: 'ease-in-out', duration: 1000, delay:100});
ScrollReveal().reveal('.ornament-behav-right', {easing: 'ease-in-out', duration: 1000, delay:100});
ScrollReveal().reveal('.ornament-behav-line', {easing: 'ease-in-out', duration: 1000, delay:500});
