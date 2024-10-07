<div>    
    {{-- hero --}}
    <section class="mt-20 md:mt-[80px] lg:mt-[85px] md:px-5" aria-label="JogjaTripTravel First Hero">
        <div id="indicators-carousel" class="relative w-full" data-carousel="static" data-carousel-touch="true">
            <!-- Carousel wrapper -->
            <div class="relative h-[25rem] md:h-[425px] lg:h-[525px] overflow-hidden md:rounded-2xl">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img src="{{ asset('/storage/arsakarta/assets/hero/hero.webp')}}"
                        class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="...">
                    <div class="absolute inset-0 flex flex-col items-center justify-center px-5 bg-black bg-opacity-70">
                        <span class="w-4/5 mx-auto leading-8 text-center text-slate-100 text-2xl lg:text-[44px] font-bold">Buat Undangan Untuk Berbagai Acara</span>
                        <p class="w-4/5 mx-auto mt-4 text-sm leading-8 text-center text-slate-100 text-opacity-65 lg:mt-5">Membuat undangan online semudah menggunakan sosial media, buat dan sebarkan undanganmu sekarang</p>
                        <a href="/admin"
                            class="z-50 text-slate-800 bg-white text-base lg:text-lg font-semibold px-8 py-2 rounded-full mt-6 lg:mt-[30px] focus:outline-none active:scale-95 transition-transform duration-150 ease-in-out">
                            Coba Sekarang
                        </a>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                    <img src="{{ asset('/storage/arsakarta/assets/hero/hero2.webp')}}"
                        class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="...">
                    <div class="absolute inset-0 flex flex-col items-center justify-center px-5 bg-black bg-opacity-70">
                        <span class="w-4/5 mx-auto leading-8 text-center text-slate-100 text-2xl lg:text-[44px] font-bold">Temukan Berbagai Tema Undangan Menarik</span>
                        <p class="w-3/4 mx-auto mt-2 text-base text-center leading-1 text-slate-100 text-opacity-65 lg:mt-5">Berbagai tema undangan online yang menarik dapat kamu temukan diplatform undangan digital Arsakarta</p>
                        <a href="#fitur"
                            class="z-50 text-slate-800 bg-white text-base lg:text-lg font-semibold px-8 py-2 rounded-full mt-4 lg:mt-[30px] focus:outline-none active:scale-95 transition-transform duration-150 ease-in-out">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                    <img src="{{ asset('/storage/arsakarta/assets/hero/hero3.webp')}}"
                        class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="...">
                    <div class="absolute inset-0 flex flex-col items-center justify-center px-5 bg-black bg-opacity-70">
                        <span class="w-4/5 mx-auto leading-8 text-center text-slate-100 text-2xl lg:text-[44px] font-bold">Temukan Berbagai Kemudahan Dalam Membuat Undangan</span>
                        <p class="w-3/4 mx-auto mt-2 text-base text-center leading-1 text-slate-100 text-opacity-65 lg:mt-5">Melalui platform undangan Arsakarta, kamu akan merasakan mudahnya dalam membuat undangan digital</p>
                        <a href="#kontak"
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

    {{-- fitur --}}
    <div id="fitur" class="flex flex-col items-center pt-24 pb-24 mx-14">
        {{-- judul --}}
        <div class="flex flex-col items-center mb-8">
            <h1 class="mb-3 text-3xl font-semibold animation-title">Fitur</h1>
            <p class="text-center animation-title-sub">Tersedia fitur untuk memaksimalkan undangan onlinemu</p>
        </div>

        {{-- fitur konten --}}
        <div class="flex flex-col items-center text-center gap-y-8 w-80">
            {{-- fitur 1 --}}
            <div class="flex flex-col items-center">
                <img src="{{ asset('/storage/arsakarta/assets/pencil-icon.png') }}" class="w-16 animation-content-icon" alt="atur konten arsakarta">
                <span class="mt-2 text-lg font-semibold animation-content-title">Atur Konten Undanganmu</span>
                <p class="mt-2 animation-content">Lorem ipsum dolor sit amet consectetur. Varius diam suspendisse a sit hendrerit</p>
            </div>
            {{-- fitur 2 --}}
            <div class="flex flex-col items-center">
                <img src="{{ asset('/storage/arsakarta/assets/design-icon.png') }}" class="w-16 animation-content-icon" alt="atur konten arsakarta">
                <span class="mt-2 text-lg font-semibold animation-content-title">Pilih Tema Sesuai Keinginan</span>
                <p class="mt-2 animation-content">Lorem ipsum dolor sit amet consectetur. Varius diam suspendisse a sit hendrerit</p>
            </div>
            {{-- fitur 3 --}}
            <div class="flex flex-col items-center">
                <img src="{{ asset('/storage/arsakarta/assets/music-icon.png') }}" class="w-16 animation-content-icon" alt="atur konten arsakarta">
                <span class="mt-2 text-lg font-semibold animation-content-title">Pilih & Unggah Lagu Sendiri</span>
                <p class="mt-2 animation-content">Lorem ipsum dolor sit amet consectetur. Varius diam suspendisse a sit hendrerit</p>
            </div>
        </div>
    </div>

    {{-- paket undangan --}}
    <div id="paket" class="flex flex-col items-center pt-24 pb-24 mx-14">
        {{-- judul --}}
        <div class="flex flex-col items-center mb-8">
            <h1 class="mb-3 text-3xl font-semibold animation-title">Paket Undangan</h1>
            <p class="text-center animation-title-sub">Tersedia berbagai pilihan paket undangan untukmu</p>
        </div>

        {{-- konten --}}
        <div class="flex flex-col items-center text-center gap-y-8 w-80">
            {{-- paket 1 --}}
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow animation-card-left dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center pt-8 pb-10">
                    {{-- <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image"/> --}}
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Free Trial</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">IDR 0</span>
                    <div class="py-10">
                        <ul class="space-y-4">
                            <li>Layout standar</li>
                            <li>3 tema gratis</li>
                            <li>1 tema premium</li>
                            <li>2 pilihan lagu</li>
                            <li>5 tamu undangan</li>
                            <li>Edit selama 1 hari</li>
                            <li class="font-semibold">Masa aktif 2 hari</li>
                        </ul>
                    </div>
                    <div class="flex md:mt-6">
                        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-full ms-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Coba Sekarang</a>
                    </div>
                </div>
            </div>
            {{-- paket 2 --}}
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow animation-card-left dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center pt-8 pb-10">
                    {{-- <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image"/> --}}
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Gold</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">IDR 79k</span>
                    <div class="py-10">
                        <ul class="space-y-4">
                            <li>Layout standar</li>
                            <li>10 tema gratis</li>
                            <li>5 tema premium</li>
                            <li>10 pilihan lagu</li>
                            <li>500 tamu undangan</li>
                            <li>Edit selama 7 hari</li>
                            <li class="font-semibold">Masa aktif 6 bulan</li>
                        </ul>
                    </div>
                    <div class="flex md:mt-6">
                        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-full ms-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Coba Sekarang</a>
                    </div>
                </div>
            </div>
            {{-- paket 3 --}}
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow animation-card-left dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center pt-8 pb-10">
                    {{-- <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image"/> --}}
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Platinum</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">IDR 129k</span>
                    <div class="py-10">
                        <ul class="space-y-4">
                            <li>Layout custom</li>
                            <li>20 tema gratis</li>
                            <li>10 tema premium</li>
                            <li>15 pilihan lagu</li>
                            <li>1000 tamu undangan</li>
                            <li>Edit selama 7 hari</li>
                            <li class="font-semibold">Masa aktif 1 tahun</li>
                        </ul>
                    </div>
                    <div class="flex md:mt-6">
                        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-full ms-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Coba Sekarang</a>
                    </div>
                </div>
            </div>
            {{-- paket 4 --}}
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow animation-card-left dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center pt-8 pb-10">
                    {{-- <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image"/> --}}
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Diamond</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">IDR 159k</span>
                    <div class="py-10">
                        <ul class="space-y-4">
                            <li>Layout custom</li>
                            <li>Unlimited tema gratis</li>
                            <li>Unlimited tema premium</li>
                            <li>Unlimited & unggah lagu</li>
                            <li>10.000 tamu undangan</li>
                            <li>Edit selama 7 hari</li>
                            <li class="font-semibold">Masa aktif 3 tahun</li>
                        </ul>
                    </div>
                    <div class="flex md:mt-6">
                        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-full ms-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Coba Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- hubungi admin --}}
    <div id="kontak" class="flex items-center pt-24 pb-24 mx-14">
        <img class="h-56 animation-hubungi-admin-icon" src="{{ asset('/storage/arsakarta/assets/admin-icon.png') }}" alt="admin arsakarta">
        <div class="flex flex-col items-end text-end">
            <h1 class="mb-3 text-3xl font-semibold animation-hubungi-admin-title">Hubungi Admin</h1>
            <p class="animation-hubungi-admin-title-sub">Temukan informasi & diskusi lebih lanjut</p>
            <div class="flex mt-4 animation-hubungi-admin-button">
                <a href="https://wa.me/62859106849531?text=Halo%20mimin%20Arsakarta,%20saya%20ingin%20informasi%20lebih%20lanjut" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-full ms-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Chat Admin</a>
            </div>
        </div>
    </div>

    {{-- faq --}}
    <div id="faq" class="flex flex-col items-center pt-24 mx-14">
        {{-- judul --}}
        <div class="flex flex-col items-center mb-8">
            <h1 class="mb-3 text-3xl font-semibold animation-title">FAQ's</h1>
            <p class="text-center animation-title-sub">Pertanyaan yang sering ditanyakan</p>
        </div>

        {{-- konten --}}
        <div class="flex flex-col items-center pb-10 text-center gap-y-8 w-80 animation-content">
            <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
                {{-- item 1 --}}
                <h2 id="accordion-flush-heading-1">
                  <button type="button" class="flex items-center justify-between w-full gap-3 py-5 font-medium text-gray-500 border-b border-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                    <span>Cara membuat undangan?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                  </button>
                </h2>
                <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                  <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400 text-start">Lorem ipsum dolor sit amet consectetur. Eu quam aliquam donec auctor scelerisque. Nisl in maecenas suspendisse ac a sapien tristique augue. Magna pellentesque in odio.</p>
                  </div>
                </div>
                {{-- item 2 --}}
                <h2 id="accordion-flush-heading-2">
                  <button type="button" class="flex items-center justify-between w-full gap-3 py-5 font-medium text-gray-500 border-b border-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
                    <span>Fitur apa saja yang didapat?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                  </button>
                </h2>
                <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                  <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400 text-start">Lorem ipsum dolor sit amet consectetur. Eu quam aliquam donec auctor scelerisque. Nisl in maecenas suspendisse ac a sapien tristique augue. Magna pellentesque in odio.</p>
                  </div>
                </div>
                {{-- item 3 --}}
                <h2 id="accordion-flush-heading-3">
                  <button type="button" class="flex items-center justify-between w-full gap-3 py-5 font-medium text-gray-500 border-b border-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3">
                    <span>Bagaimana cara export pdf?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                  </button>
                </h2>
                <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                  <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400 text-start">The main difference is that the core components from Flowbite are open source under the MIT license, whereas Tailwind UI is a paid product. Another difference is that Flowbite relies on smaller and standalone components, whereas Tailwind UI offers sections of pages.</p>
                  </div>
                </div>
                {{-- item 4 --}}
                <h2 id="accordion-flush-heading-4">
                  <button type="button" class="flex items-center justify-between w-full gap-3 py-5 font-medium text-gray-500 border-b border-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-4" aria-expanded="false" aria-controls="accordion-flush-body-4">
                    <span class="text-start">Metode pembayaran yang tersedia?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                  </button>
                </h2>
                <div id="accordion-flush-body-4" class="hidden" aria-labelledby="accordion-flush-heading-4">
                  <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400 text-start">The main difference is that the core components from Flowbite are open source under the MIT license, whereas Tailwind UI is a paid product. Another difference is that Flowbite relies on smaller and standalone components, whereas Tailwind UI offers sections of pages.</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
