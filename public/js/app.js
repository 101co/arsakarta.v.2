let currentIndex = 0;
let animationTopLeft;
let animationTopRight;
let animationBottomLeft;
let animationBottomRight;
var timeline = gsap.timeline();
            
function selectItem(index) {
    const navItems = document.getElementById("nav-items");
    const totalItems = navItems.children.length;
    const itemsToShow = 5;
    let selectedMenu = navItems.children[index].innerText;

    document.querySelectorAll(".content-page").forEach((page) => {
        page.classList.add("hidden");
        page.classList.remove("flex");
    });
    document.getElementById(`page${index}`).classList.remove("hidden");
    document.getElementById(`page${index}`).classList.add("flex");

    if (totalItems > itemsToShow) {
        let offset;

        if (index < 2) {
            offset = 0;
        } else if (index >= totalItems - 2) {
            offset = totalItems - itemsToShow;
        } else {
            offset = index - 2;
        }

        navItems.style.transform = `translateX(-${offset * (100 / 15)}%)`;
    }

    currentIndex = index;
    updateActiveClass();
    animateAll(selectedMenu);
}

function updateActiveClass() {
    const navItems = document.querySelectorAll(".nav-item");
    navItems.forEach((item, index) => {
        item.classList.remove("bg-slate-100");
        if (index === currentIndex) {
            item.classList.add("bg-slate-100");
        }
    });
}

function animateAll(selectedMenu) {
    animateOrnament();
    console.log('animatedAll');

    switch (selectedMenu.toLowerCase()) {
        case 'opening':
            console.log('opening');
            animateOpening();
            break;
        case 'quote':
            console.log('quote');
            animateQuote();
            break;
        case 'mempelai':
            console.log('mempemlai');
            animateMempelai();
            break;
    
        default:
            break;
    }
}

function animateOpening() {
    timeline.clear();
    timeline.play();
    timeline.fromTo("#opening-title", { opacity: 0, y: -20 }, { opacity: 1, y: 0, duration: 1 })
        .fromTo("#opening-couple-name", { opacity: 0, y:-30 }, { opacity: 1, y: 0, duration: 1.5 }, "-=0.7")
        .fromTo("#opening-guest", { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 1 }, "-=0.9")
        .fromTo("#opening-button-open-invitation", { opacity: 0, y: -20 }, { opacity: 1, y: 0, duration: 0.7 }, "<1");
    timeline.paused();
}

function animateQuote() {
    gsap.fromTo("#quote-content", 
        { scale: 0 },
        { y: -50, scale: 1, duration: 1.5, ease: "ease.out" });
}

function animateMempelai() {
    timeline.clear();
    timeline.play();
    timeline.fromTo("#mempelai-title", { opacity: 0, y: -20 }, { opacity: 1, y: 0, duration: 1 })
        .fromTo("#mempelai-sub-title", { opacity: 0, y:-30 }, { opacity: 1, y: 0, duration: 1.5 }, "-=0.7")
        .fromTo("#mempelai-pria", { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 1 }, "<1")
        .fromTo("#mempelai-pria-sub", { opacity: 0, y: -10 }, { opacity: 1, y: 0, duration: 1.5 }, "-=0.9")
        .fromTo("#mempelai-sub-title2", { opacity: 0, y: -10 }, { opacity: 1, y: 0, duration: 0.7 }, "-=0.5")
        .fromTo("#mempelai-wanita", { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 1 }, "<1")
        .fromTo("#mempelai-wanita-sub", { opacity: 0, y: -10 }, { opacity: 1, y: 0, duration: 1.5 }, "-=0.9");
    timeline.paused();
}

function animateOrnament() {
    gsap.killTweensOf("#object-tl, #object-tr, #object-bl, #object-br");
    gsap.set("#object-tl", { opacity: 1, x: -80, y: -80 });
    gsap.to("#object-tl", {
        x: 0, 
        y: 0, 
        duration: 1.5, 
        onComplete: function() {
            gsap.to("#object-tl", { 
                x: 5, 
                y: 7, 
                duration: 1.5, 
                repeat: -1, 
                yoyo: true, 
                ease: "power1.inOut"
            });
        }
    });
    
    gsap.set("#object-tr", { opacity: 1, x: 80, y: -80 });
    gsap.to("#object-tr", {
        x: 0, 
        y: 0, 
        duration: 1.5, 
        onComplete: function() {
            gsap.to("#object-tr", { 
                x: -5, 
                y: 7, 
                duration: 1.5, 
                repeat: -1, 
                yoyo: true, 
                ease: "power1.inOut"
            });
        }
    });
    
    gsap.set("#object-bl", { opacity: 1, x: -80, y: 80 });
    gsap.to("#object-bl", {
        x: 0, 
        y: 0, 
        duration: 1.5, 
        onComplete: function() {
            gsap.to("#object-bl", { 
                x: 5, 
                y: -7, 
                duration: 1.5, 
                repeat: -1, 
                yoyo: true, 
                ease: "power1.inOut"
            });
        }
    });
    
    gsap.set("#object-br", { opacity: 1, x: 80, y: 80 });
    gsap.to("#object-br", {
        x: 0, 
        y: 0, 
        duration: 1.5, 
        onComplete: function() {
            gsap.to("#object-br", { 
                x: -5, 
                y: -7, 
                duration: 1.5, 
                repeat: -1, 
                yoyo: true, 
                ease: "power1.inOut"
            });
        }
    });

    gsap.set("#object-ct", { opacity: 1, y: -30 });
    gsap.to("#object-ct", { y: 0, duration: 1.5 });
    gsap.set("#object-cb", { opacity: 1, y: 30 });
    gsap.to("#object-cb", { y: 0, duration: 1.5 });
    gsap.set("#object-cl", { opacity: 1, x: -30 });
    gsap.to("#object-cl", { x: 0, duration: 1.5 });
    gsap.set("#object-cr", { opacity: 1, x: 30 });
    gsap.to("#object-cr", { x: 0, duration: 1.5 });
}

function openInvitation() {
    gsap.to("#ornament-cover, #page0", {
        x:-500,
        duration: 1,
        onComplete: function() {
            document.getElementById("button-open-invitation").classList.add("hidden");

            gsap.set("#page0, #opening-title, #opening-couple-name, #opening-guest, #opening-button-open-invitation", {x:0, opacity:0});
            gsap.to("#page0, #media-button, #bottom-navigation", {
                opacity: 1,
                duration: 0.5,
                onComplete: function(){
                    animateAll('opening');
                }
            });
            
        }
    });
}