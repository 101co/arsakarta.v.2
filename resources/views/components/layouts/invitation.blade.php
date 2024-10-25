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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        .sk-folding-cube {
        margin: 20px auto;
        width: 40px;
        height: 40px;
        position: relative;
        -webkit-transform: rotateZ(45deg);
                transform: rotateZ(45deg);
        }

        .sk-folding-cube .sk-cube {
        float: left;
        width: 50%;
        height: 50%;
        position: relative;
        -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
                transform: scale(1.1); 
        }
        .sk-folding-cube .sk-cube:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #333;
        -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
                animation: sk-foldCubeAngle 2.4s infinite linear both;
        -webkit-transform-origin: 100% 100%;
            -ms-transform-origin: 100% 100%;
                transform-origin: 100% 100%;
        }
        .sk-folding-cube .sk-cube2 {
        -webkit-transform: scale(1.1) rotateZ(90deg);
                transform: scale(1.1) rotateZ(90deg);
        }
        .sk-folding-cube .sk-cube3 {
        -webkit-transform: scale(1.1) rotateZ(180deg);
                transform: scale(1.1) rotateZ(180deg);
        }
        .sk-folding-cube .sk-cube4 {
        -webkit-transform: scale(1.1) rotateZ(270deg);
                transform: scale(1.1) rotateZ(270deg);
        }
        .sk-folding-cube .sk-cube2:before {
        -webkit-animation-delay: 0.3s;
                animation-delay: 0.3s;
        }
        .sk-folding-cube .sk-cube3:before {
        -webkit-animation-delay: 0.6s;
                animation-delay: 0.6s; 
        }
        .sk-folding-cube .sk-cube4:before {
        -webkit-animation-delay: 0.9s;
                animation-delay: 0.9s;
        }
        @-webkit-keyframes sk-foldCubeAngle {
        0%, 10% {
            -webkit-transform: perspective(140px) rotateX(-180deg);
                    transform: perspective(140px) rotateX(-180deg);
            opacity: 0; 
        } 25%, 75% {
            -webkit-transform: perspective(140px) rotateX(0deg);
                    transform: perspective(140px) rotateX(0deg);
            opacity: 1; 
        } 90%, 100% {
            -webkit-transform: perspective(140px) rotateY(180deg);
                    transform: perspective(140px) rotateY(180deg);
            opacity: 0; 
        } 
        }

        @keyframes sk-foldCubeAngle {
        0%, 10% {
            -webkit-transform: perspective(140px) rotateX(-180deg);
                    transform: perspective(140px) rotateX(-180deg);
            opacity: 0; 
        } 25%, 75% {
            -webkit-transform: perspective(140px) rotateX(0deg);
                    transform: perspective(140px) rotateX(0deg);
            opacity: 1; 
        } 90%, 100% {
            -webkit-transform: perspective(140px) rotateY(180deg);
                    transform: perspective(140px) rotateY(180deg);
            opacity: 0; 
        }
        }
        body {
            overflow-y: hidden; /* Mencegah scroll vertikal */
        }

        #content {
            height: calc(100vh - env(safe-area-inset-bottom));
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader" class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-slate-200">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>

    <div id="content" class="max-w-lg px-2 py-2 mx-auto">
        <div class="flex items-center justify-center w-full h-full overflow-hidden bg-white rounded-3xl">
            <div class="w-full h-full">
                {{ $slot }}
            </div>
        </div>
    </div>

    {{-- <div id="content" class="h-screen max-w-lg px-2 py-2 mx-auto">
        <div class="flex items-center justify-center w-full h-full overflow-hidden bg-white rounded-3xl">
            <div class="w-full h-full">
                {{ $slot }}
            </div>
        </div>
    </div> --}}

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    @livewireScripts
</body>
</html>