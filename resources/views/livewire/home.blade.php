<div>    {{-- hero --}}
    <section class="mt-20 md:mt-[80px] lg:mt-[85px] md:px-5" aria-label="JogjaTripTravel First Hero">
        <div id="indicators-carousel" class="relative w-full" data-carousel="static" data-carousel-touch="true">
            <!-- Carousel wrapper -->
            <div class="relative h-[25rem] md:h-[425px] lg:h-[525px] overflow-hidden md:rounded-2xl">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img src="{{ asset('/storage/01J8RRFG4T7FATV1EDEFRZH6WE.jpg')}}"
                        class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="...">
                    <div class="absolute inset-0 flex flex-col items-center justify-center px-5 bg-black bg-opacity-70">
                        <h1 class="w-4/5 mx-auto leading-8 text-center text-slate-100 text-2xl lg:text-[44px] font-bold">Buat Undangan Untuk Berbagai Acara</h1>
                        <p class="w-4/5 mx-auto mt-4 text-sm leading-8 text-center text-slate-100 text-opacity-65 lg:mt-5">Membuat undangan online semudah menggunakan sosial media, buat dan sebarkan undanganmu sekarang.</p>
                        <a href="#travel-catalogue"
                            class="z-50 text-slate-800 bg-white text-base lg:text-lg font-semibold px-8 py-2 rounded-full mt-6 lg:mt-[30px] focus:outline-none active:scale-95 transition-transform duration-150 ease-in-out">
                            Coba Sekarang
                        </a>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                    <img src="{{ asset('/storage/01J8RRFG4T7FATV1EDEFRZH6WE.jpg')}}"
                        class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="...">
                    <div class="absolute inset-0 flex flex-col items-center justify-center px-5 bg-black bg-opacity-70">
                        <h1 class="w-4/5 mx-auto leading-8 text-center text-slate-100 text-2xl lg:text-[44px] font-bold">Jogja Trip Travel</h1>
                        <p class="w-3/4 mx-auto mt-2 text-base text-center leading-1 text-slate-100 text-opacity-65 lg:mt-5">Temukan informasi lebih lanjut tentang pilihan wisata dari Jogja Trip Travel</p>
                        <a href="#contact"
                            class="z-50 text-slate-800 bg-white text-base lg:text-lg font-semibold px-8 py-2 rounded-full mt-4 lg:mt-[30px] focus:outline-none active:scale-95 transition-transform duration-150 ease-in-out">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                    <img src="{{ asset('/storage/01J8RRFG4T7FATV1EDEFRZH6WE.jpg')}}"
                        class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="...">
                    <div class="absolute inset-0 flex flex-col items-center justify-center px-5 bg-black bg-opacity-70">
                        <h1 class="w-4/5 mx-auto leading-8 text-center text-slate-100 text-2xl lg:text-[44px] font-bold">Sosial Media Jogja Trip Travel</h1>
                        <p class="w-3/4 mx-auto mt-2 text-base text-center leading-1 text-slate-100 text-opacity-65 lg:mt-5">Intip berbagai keseruan wisata Jogja melalui akun sosial media kami</p>
                        <a href="#contact"
                            class="z-50 text-slate-800 bg-white text-base lg:text-lg font-semibold px-8 py-2 rounded-full mt-4 lg:mt-[30px] focus:outline-none active:scale-95 transition-transform duration-150 ease-in-out">
                            Ikuti Kami
                        </a>
                    </div>
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex space-x-3 -translate-x-1/2 rtl:space-x-reverse bottom-5 left-1/2">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer start-0 group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-2 h-2 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer end-0 group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-2 h-2 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </section>
</div>
