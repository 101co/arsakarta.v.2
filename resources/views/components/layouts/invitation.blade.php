<!-- resources/views/layouts/invitation.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Undangan Online')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    @livewireStyles
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-slate-100">
    <!-- Preloader -->
    <div id="preloader" class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-slate-200">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>

    {{ $slot }}
    {{-- <div id="content" class="h-screen max-w-lg px-2 py-2 mx-auto">
        <div class="flex items-center justify-center w-full h-full overflow-hidden bg-white rounded-3xl">
            <div class="w-full h-full">
                {{ $slot }}
            </div>
        </div>
    </div> --}}

    @livewireScripts
    <script>
        function adjustHeight() {
            const content = document.getElementById('content');
            // Mengurangi tinggi viewport untuk memperhitungkan address bar
            const vh = window.innerHeight * 0.01; // 1% dari tinggi viewport
            content.style.height = `${vh * 100}px`; // Atur tinggi content ke 100vh yang disesuaikan
        }
    
        window.addEventListener('resize', adjustHeight);
        window.addEventListener('load', adjustHeight);
        adjustHeight(); // Panggil fungsi saat pertama kali dimuat
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>