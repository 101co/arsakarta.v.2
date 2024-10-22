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
</head>
<body>
    <!-- Preloader -->
    <div id="preloader" class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-slate-200">
        <div class="loader"></div>
    </div>

    <div id="content" class="h-screen max-w-lg px-2 py-2 mx-auto">
        <div class="flex items-center justify-center w-full h-full overflow-hidden bg-white rounded-3xl">
            <div class="w-full h-full">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Floating Icons -->
    <div class="fixed flex flex-col space-y-3 bottom-10 right-4">
        <a href="#">
            <ion-icon class="items-center p-4 text-xl text-white bg-gray-400 rounded-full cursor-pointer hover:bg-slate-400" name="qr-code-outline"></ion-icon>
        </a>
        <a href="#">
            <ion-icon class="items-center p-4 text-xl text-white bg-gray-400 rounded-full cursor-pointer hover:bg-slate-400" name="volume-high-outline"></ion-icon>
        </a>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    @livewireScripts
</body>
</html>