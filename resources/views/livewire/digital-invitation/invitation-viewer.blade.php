<div class="relative w-full h-full bg-cover" style="background-image: url('{{ asset('storage/arsakarta/assets/theme/simple/background001.jpg') }}');">
    @foreach ($items as $index => $item)
    <div id="page{{$index}}" class="{{$index == 0 ? 'relative':''}} z-40 flex items-center justify-center h-full overflow-hidden bg-cover content-page rounded-xl" style="background-image: url('{{ asset('storage/arsakarta/assets/theme/simple/background001.jpg') }}');">
        <div class="p-4 space-y-4">
        {!! $item[$index]['content'] = str_replace('{{ namaTamu }}', $namaTamu, $item['content']) !!}
        </div>
    </div>
    @endforeach

    <div id="bottom-navigation" class="absolute bottom-0 left-0 w-full px-2 pt-3 mb-2">
        <div class="px-2 py-2 bg-white shadow-md rounded-2xl">
            <div id="navigation-container" class="relative overflow-hidden">
                <div id="nav-items" class="flex transition-transform duration-300" style="min-width: 300%;">
                    @foreach ($items as $index => $item)
                        <button class="nav-item flex flex-col items-center justify-center space-y-2 h-full py-4 text-gray-700 transition-all duration-300 ease-in-out transform rounded-lg {{ $index == 0 ? 'bg-slate-100' : '' }}" data-index="{{ $index }}" onclick="selectItem({{ $index }})" style="flex: 0 0 calc(100% / 15);">
                            <ion-icon name="home-sharp" class="size-6 text-slate-600"></ion-icon>
                            <span class="text-xs text-center text-slate-600">{{ $item['menu'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <!-- Floating Icons -->
    <div id="media-button" class="absolute z-50 flex-col hidden space-y-3 bottom-32 right-4">
        <a href="#">
            <ion-icon class="items-center p-4 text-xl text-white ease-in-out rounded-full cursor-pointer opacity-55 bg-slate-400 hover:bg-slate-500" name="qr-code-outline"></ion-icon>
        </a>
        <a href="#">
            <ion-icon class="items-center p-4 text-xl text-white ease-in-out rounded-full cursor-pointer opacity-55 bg-slate-400 hover:bg-slate-500" name="volume-high-outline"></ion-icon>
        </a>
    </div>

    <script>
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
    </script>
</div>