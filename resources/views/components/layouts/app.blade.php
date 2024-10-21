<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        
    @livewireStyles
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="antialiased">
    {{-- header --}}
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-900 start-0 dark:border-gray-600">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('/storage/arsakarta/assets/logo.svg') }}" class="h-12" alt="Arsakarta Logo">
            </a>
            <div class="flex space-x-3 md:order-2 md:space-x-0 rtl:space-x-reverse">
                <a href="/admin" type="button" class="px-8 py-2 text-sm font-medium text-center text-white rounded-full bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Login</a>
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="items-center justify-center hidden w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#"
                            class="block px-3 py-2 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{ $slot }}

    {{-- footer --}}
    <footer class="py-6 text-white bg-slate-800 pb-28">
        <div class="container px-4 mx-auto">
          <!-- Logo dan Deskripsi -->
          <div class="mb-4 text-center">
            <h1 class="text-2xl font-bold">Arsakarta</h1>
            <p class="mt-2 text-sm text-gray-400">Platform undangan digital untuk berbagai acaramu</p>
          </div>
      
          <!-- Navigasi -->
          <div class="my-10 text-center">
            <ul class="space-y-2">
              <li><a href="#" class="hover:text-gray-300">Tentang Kami</a></li>
              <li><a href="#" class="hover:text-gray-300">Layanan</a></li>
              <li><a href="#" class="hover:text-gray-300">Kontak</a></li>
              <li><a href="#" class="hover:text-gray-300">Kebijakan Privasi</a></li>
            </ul>
          </div>
      
          <!-- Ikon Media Sosial -->
          <div class="mb-6 text-center">
            <div class="flex justify-center space-x-4">
              <!-- Instagram -->
              <a href="https://instagram.com/arsakarta" class="hover:text-gray-400">
                <ion-icon name="logo-instagram" class="size-6"></ion-icon>
              </a>
      
              <!-- Website -->
              <a href="https://arsakarta.com" class="hover:text-gray-400">
                <ion-icon name="globe-outline" class="size-6"></ion-icon>
              </a>
      
              <!-- WhatsApp -->
              <a href="https://wa.me/62859106849531?text=Halo%20mimin%20Arsakarta,%20saya%20ingin%20informasi%20lebih%20lanjut" class="hover:text-gray-400">
                <ion-icon name="logo-whatsapp" class="size-6"></ion-icon>
              </a>
            </div>
          </div>
      
          <!-- Copyright -->
          <div class="text-sm text-center text-gray-500">
            <p>&copy; {{ date('Y') }} Arsakarta. Semua Hak Dilindungi.</p>
          </div>
        </div>
    </footer>

    {{-- mobile navigation --}}
    <nav class="fixed inset-x-0 bottom-0 text-white shadow-lg bg-slate-700">
        <div class="flex items-center justify-between px-4 py-4">
          <!-- Home -->
          <a href="#" class="flex flex-col items-center text-sm gap-y-2 hover:text-gray-400">
            <x-heroicon-o-home class="w-6"/>
            <span>Beranda</span>
          </a>
      
          <!-- Profile -->
          <a href="#fitur" class="flex flex-col items-center text-sm gap-y-2 hover:text-gray-400">
            <x-heroicon-s-sparkles class="w-6"/>
            <span>Fitur</span>
          </a>
      
          <!-- Pesan -->
          <a href="#paket" class="flex flex-col items-center text-sm gap-y-2 hover:text-gray-400">
            <x-heroicon-o-currency-dollar class="w-6"/>
            <span>Paket</span>
          </a>
      
          <!-- Pengaturan -->
          <a href="#kontak" class="flex flex-col items-center text-sm gap-y-2 hover:text-gray-400">
            <x-heroicon-o-phone class="w-6"/>
            <span>Kontak</span>
          </a>
      
          <!-- Pengaturan -->
          <a href="#faq" class="flex flex-col items-center text-sm gap-y-2 hover:text-gray-400">
            <x-heroicon-o-question-mark-circle class="w-6"/>
            <span>Pertanyaan</span>
          </a>
        </div>
    </nav>
    @livewireScripts
</body>

</html>