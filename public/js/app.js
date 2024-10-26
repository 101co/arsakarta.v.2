let currentIndex = 0;
var timeline = gsap.timeline();
let animationTopLeft;
let animationTopRight;
let animationBottomLeft;
let animationBottomRight;
            
function selectItem(index) {
    const navItems = document.getElementById("nav-items");
    const totalItems = navItems.children.length;
    const itemsToShow = 5; // Jumlah item yang akan ditampilkan

    // Sembunyikan semua halaman konten
    document.querySelectorAll(".content-page").forEach((page) => {
        page.classList.add("hidden");
        page.classList.remove("flex");
    });

    // Tampilkan halaman yang dipilih berdasarkan indeks
    document.getElementById(`page${index}`).classList.remove("hidden");
    document.getElementById(`page${index}`).classList.add("flex");

    // Hitung offset untuk pergeseran
    if (totalItems > itemsToShow) {
        let offset;

        if (index < 2) {
            // Jika index 0 atau 1, tidak perlu geser
            offset = 0;
        } else if (index >= totalItems - 2) {
            // Jika item berada di 2 item terakhir, geser ke kiri
            offset = totalItems - itemsToShow; // Geser ke kanan sampai item terakhir
        } else {
            // Untuk item ke-3 sampai item ke-(totalItems - 3)
            offset = index - 2; // Tempatkan item yang dipilih di tengah
        }

        // Terapkan pergeseran dengan totalItems sebagai 15
        navItems.style.transform = `translateX(-${offset * (100 / 15)}%)`;
    }

    // Update index saat ini
    currentIndex = index;

    // Mengubah kelas aktif
    updateActiveClass();
    animateAll();
}

function updateActiveClass() {
    const navItems = document.querySelectorAll(".nav-item");
    navItems.forEach((item, index) => {
        item.classList.remove("bg-slate-100"); // Menghapus kelas aktif dari semua item
        if (index === currentIndex) {
            item.classList.add("bg-slate-100"); // Menambahkan kelas aktif pada item yang dipilih
        }
    });
}

function animateAll() {
    animateOpening();
}

function animateOpening() {
    console.log('animateOpening');
    if (animationTopLeft || animationTopRight || animationBottomLeft || animationBottomRight) {
        animationTopLeft.revert();
        animationTopRight.revert();
        animationBottomLeft.revert();
        animationBottomRight.revert();
      }

    timeline.clear();
    timeline.play();
    timeline.fromTo("#opening-title", { opacity: 0, y: -20 }, { opacity: 1, y: 0, duration: 1 })
        .fromTo("#opening-couple-name", { opacity: 0, y:-30 }, { opacity: 1, y: 0, duration: 1.5 }, "-=0.7")
        .fromTo("#opening-guest", { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 1 }, "-=0.9")
        .fromTo("#opening-button-open-invitation", { opacity: 0, y: -20 }, { opacity: 1, y: 0, duration: 0.7 }, "<1");
    timeline.paused();

    animationTopLeft = gsap.to("#object-tl", {x: 5, y: 7, duration: 1.5, repeat: -1, yoyo: true, ease: "power1.inOut"});
    animationTopRight = gsap.to("#object-tr", {x: -5, y: 7, duration: 1.5, repeat: -1, yoyo: true, ease: "power1.inOut"});
    animationBottomLeft = gsap.to("#object-bl", {x: 5, y: -7, duration: 1.5, repeat: -1, yoyo: true, ease: "power1.inOut"});
    animationBottomRight = gsap.to("#object-br", {x: -5, y: -7, duration: 1.5, repeat: -1, yoyo: true, ease: "power1.inOut"});
}

function openInvitation() {
    gsap.fromTo(
        ".ornament",
        { opacity: 0 }, // Nilai awal
        { opacity: 1, duration: 5 } // Nilai akhir
    );

    document.querySelectorAll(".ornament").forEach((page) => {
        page.classList.remove("hidden");
    });

    document.querySelectorAll(".ornament-cover").forEach((page) => {
        page.classList.add("hidden");
    });
    
    gsap.fromTo(
        ".ornament-cover",
        { y: 0 }, // Nilai awal
        { y: 1000, duration: 5 } // Nilai akhir
    );

    gsap.to("#page0", {
        opacity: 0,
        duration: 1,
        onComplete: function() {
            // document.getElementById("page0").classList.remove("relative");
            document.getElementById("bottom-navigation").classList.add("z-50");
            document.getElementById("button-open-invitation").classList.add("hidden");
            
            animateAll();
            gsap.to("#page0", {
                opacity: 1,
                duration: 1
            });
        }
    });
}