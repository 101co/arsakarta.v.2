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

    <script src="https://unpkg.com/scrollreveal"></script>

    <style>
        /* Hide the page content while loading */
        #content {
            display: none;
        }
        /* Animation for loader */
        .loader {
            border: 8px solid #CBD5E1; /* Light grey */
            border-top: 8px solid #475569; /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1.5s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="py-2 bg-slate-200">
    <!-- Preloader -->
    <div id="preloader" class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-slate-200">
        <div class="loader"></div>
    </div>

    {{-- <div class="flex items-center justify-center h-[calc(100vh-1rem)] max-w-lg mx-auto overflow-hidden bg-cover rounded-xl" style="background-image: url('{{ asset('storage/arsakarta/assets/theme/simple/background001.jpg') }}');"> --}}
        {{-- cover --}}
        {{-- <div class="p-4 space-y-4">
            <h2 class="text-lg font-normal tracking-widest text-center uppercase">The Wedding Of</h2>
            <h3 class="text-4xl font-normal tracking-widest text-center uppercase">Bima & Shinta</h3>
            <div class="pt-4 space-y-1 font-light text-center">
                <p>Kepada Yth:</p>
                <p>Bapak/Ibu/Saudara/i</p>
                <p class="font-semibold">Nama Tamu</p>
            </div>
            <div class="p-4 text-center">
                <button class="px-4 py-2 text-sm text-center text-white duration-300 ease-in-out rounded-full hover:scale-105 bg-slate-500">Buka Undangan</button>
            </div>
        </div>
    </div> --}}

    <!-- Floating Icons -->
    <div class="fixed flex flex-col space-y-3 bottom-10 right-4">
        <!-- Icon 1 -->
        <a href="#">
            <ion-icon class="items-center p-4 text-xl text-white rounded-full cursor-pointer bg-slate-500 hover:bg-slate-400" name="qr-code-outline"></ion-icon>
        </a>

        <a href="#">
            <ion-icon class="items-center p-4 text-xl text-white rounded-full cursor-pointer bg-slate-500 hover:bg-slate-400" name="volume-high-outline"></ion-icon>
        </a>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <!-- Livewire Scripts and any additional JS -->
    <script>
        // Hide preloader and show content after a delay (1000 ms or 1 second)
        window.addEventListener('load', function () {
            setTimeout(function () {
                document.getElementById('preloader').style.display = 'none'; // Hide loader
                document.getElementById('content').style.display = 'block';  // Show page content
            }, 1000); // 1000 ms = 1 second delay
        });
    </script>
</body>

</html>