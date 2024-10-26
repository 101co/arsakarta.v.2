let currentIndex = 0;
            
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

    animateTitle();

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
function animateTitle() {
    // Reset posisi elemen ke keadaan awal
    gsap.set(".animation-title", { opacity: 0, y: -50 });
    
    // Jalankan animasi
    gsap.fromTo(
        ".animation-title",
        { opacity: 0, y: -50 }, // Nilai awal
        { opacity: 1, y: 0, duration: 1 } // Nilai akhir
    );
}

function openInvitation() {
    gsap.to("#page0", {
        opacity: 0,
        duration: 1,
        onComplete: function() {
            document.getElementById("page0").classList.remove("relative");
            document.getElementById("button-open-invitation").classList.add("hidden");
            
            animateTitle();
            gsap.to("#page0", {
                opacity: 1,
                duration: 1
            });
        }
    });
}