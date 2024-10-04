{{-- <!DOCTYPE html>
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

    
    <style>
        .bg-custom {
            background-image: url('{{ asset('/storage/asset-invitation/javanese-gunungan-1.png') }}');
            background-size: 80%;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.8;
        }

        .animated-bg {
            background-image: url('{{ asset('/storage/asset-invitation/javanese-leafs.png') }}'); /* Another background image */
            background-size: 140%; /* Start size */
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            animation: bgGrow 1s ease-in-out, fadeIn 1s ease-in forwards; /* Animation for growing background */
        }

        .animated-bg-2 {
            background-image: url('{{ asset('/storage/asset-invitation/javanese-edge.png') }}'); /* Another background image */
            background-size: 90%; /* Start size */
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            animation: bgGrow2 1s ease-in-out, fadeIn 1s ease-in forwards; /* Animation for growing background */
        }

        @keyframes bgGrow {
            0% {
                background-size: 50%; /* Start smaller */
            }
            100% {
                background-size: 140%; /* End larger */
            }
        }

        @keyframes bgGrow2 {
            0% {
                background-size: 50%; /* Start smaller */
            }
            100% {
                background-size: 90%; /* End larger */
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0; /* Start fully transparent */
            }
            100% {
                opacity: 1; /* End fully visible */
            }
        }
    </style>
    {{-- <script src="https://unpkg.com/scrollreveal"></script> --}}

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    {{-- <div id="invitation" class="relative h-screen flex bg-[#3d1f17]">
        <!-- Left Cover -->
        <div id="leftCover" class="z-10 absolute inset-y-0 left-0 w-1/2  bg-[#3d1f17] flex items-center justify-center transition-transform duration-1000 transform">
            <img id="gunungan-left" class="absolute top-1/4 right-0 w-[100px] transition-transform duration-1000 transform" src="{{ asset('/storage/asset-invitation/javanese-gunungan-left-1.png') }}" alt="">
            <img class="absolute bottom-0 w-full" src="{{ asset('/storage/asset-invitation/javanese-ornamen-1.png') }}" alt="">
            <img class="absolute top-0 w-full" src="{{ asset('/storage/asset-invitation/javanese-ornamen-1.png') }}" alt="">
        </div>
        <!-- Right Cover -->
        <div id="rightCover" class="z-10 absolute inset-y-0 right-0 w-1/2 bg-[#3d1f17] flex items-center justify-center transition-transform duration-1000 transform">
            <img id="gunungan-right" class="absolute top-1/4 left-0 w-[101px] transition-transform duration-1000 transform" src="{{ asset('/storage/asset-invitation/javanese-gunungan-right-1.png') }}" alt="">
            <img class="absolute bottom-0 w-full" src="{{ asset('/storage/asset-invitation/javanese-ornamen-1.png') }}" alt="">
            <img class="absolute top-0 w-full" src="{{ asset('/storage/asset-invitation/javanese-ornamen-1.png') }}" alt="">
        </div>
        <!-- Content -->
        <div id="content" class="relative hidden w-full h-auto overflow-y-scroll scroll-smooth">
            <div class="fixed inset-0 bg-custom opacity-10 -z-0"></div>
        
            <!-- Section 1 -->
            <div class="relative flex items-center h-full overflow-hidden">
                <div class="absolute inset-0 animated-bg -z-0"></div>
                <div class="absolute inset-0 animated-bg-2"></div>

                <p class="text-center text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae ipsa eum maiores unde sunt accusantium natus corporis, quibusdam, dignissimos, corrupti ab modi est eveniet culpa dolorum earum voluptates! Incidunt, iste.</p>
            </div>
            <div class="relative flex items-center h-full section-1">
                <div class="absolute inset-0 animated-bg -z-0"></div>
                <div class="absolute inset-0 animated-bg-2"></div>

                <p class="text-center text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae ipsa eum maiores unde sunt accusantium natus corporis, quibusdam, dignissimos, corrupti ab modi est eveniet culpa dolorum earum voluptates! Incidunt, iste.</p>
            </div>
        </div>
    </div> --}}

    <!-- Button Positioned in Front of the Center of the Cover -->
    {{-- <div id="namaMempelai" class="z-50 absolute flex w-full justify-center top-[68%] transition-transform duration-1000 transform">
        <h1 class="font-semibold text-3xl text-[#ffefd9]">Arsa & Nika</h1>
    </div>
    <button id="openButton" class="absolute bg-white text-[#3d1f17] py-2 px-4 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 z-10 transform -translate-x-1/2 -translate-y-1/2">
        Buka Undangan
    </button> --}}

    {{-- <script>
        const openButton = document.getElementById('openButton');
        const leftCover = document.getElementById('leftCover');
        const rightCover = document.getElementById('rightCover');
        const gununganLeft = document.getElementById('gunungan-left');
        const gununganRight = document.getElementById('gunungan-right');
        const content = document.getElementById('content');
        const namaMempelai = document.getElementById('namaMempelai');
    
        openButton.addEventListener('click', () => {
            leftCover.classList.add('-translate-x-full');
            rightCover.classList.add('translate-x-full');
            gununganLeft.classList.add('translate-x-84');
            gununganRight.classList.add('-translate-x-84');
            content.classList.remove('hidden');
            openButton.classList.add('hidden');
            namaMempelai.classList.add('hidden');
        });
    </script> --}}

    {{-- <style>
        #openButton {
            top: 80%;
            left: 50%;
        }
    </style> --}}

    <div class="container flex flex-col px-10 mx-auto">
        <div class="flex flex-col items-center w-full bg-yellow-200 ">
            <h1 class="h-full text-4xl hel1 py-96">TEST</h1>
        </div>
        <div class="flex flex-col items-center w-full bg-yellow-400 ">
            <h1 class="h-full text-4xl hel2 py-96">TEST2</h1>
        </div>
    </div>
</body>

</html> --}}