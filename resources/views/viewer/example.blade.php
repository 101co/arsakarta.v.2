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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <div id="invitation" class="relative h-screen overflow-hidden flex">
        <!-- Left Cover -->
        <div id="leftCover" class="absolute inset-y-0 left-0 w-1/2  bg-[#3d1f17] flex items-center justify-center transition-transform duration-1000 transform">
            <img id="gunungan-left" class="absolute top-1/4 right-0 w-[100px] transition-transform duration-1000 transform" src="{{ asset('/storage/asset-invitation/javanese-gunungan-left-1.png') }}" alt="">
            <img class="absolute bottom-0 w-full" src="{{ asset('/storage/asset-invitation/javanese-ornamen-1.png') }}" alt="">
            <img class="absolute top-0 w-full" src="{{ asset('/storage/asset-invitation/javanese-ornamen-1.png') }}" alt="">
        </div>
        <!-- Right Cover -->
        <div id="rightCover" class="absolute inset-y-0 right-0 w-1/2 bg-[#3d1f17] flex items-center justify-center transition-transform duration-1000 transform">
            <img id="gunungan-right" class="absolute top-1/4 left-0 w-[101px] transition-transform duration-1000 transform" src="{{ asset('/storage/asset-invitation/javanese-gunungan-right-1.png') }}" alt="">
            <img class="absolute bottom-0 w-full" src="{{ asset('/storage/asset-invitation/javanese-ornamen-1.png') }}" alt="">
            <img class="absolute top-0 w-full" src="{{ asset('/storage/asset-invitation/javanese-ornamen-1.png') }}" alt="">
        </div>
        <!-- Content -->
        <div id="content" class="p-6 hidden w-full overflow-y-auto h-auto">
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
            <h2 class="text-gray-800 text-xl font-semibold mb-4">Event Details</h2>
            <p class="text-gray-600 mb-4">Join us for a special celebration on [Date] at [Venue].</p>
            <p class="text-gray-600">Looking forward to seeing you there!</p>
        </div>
    </div>

    <!-- Button Positioned in Front of the Center of the Cover -->
    <div id="namaMempelai" class="absolute flex w-full justify-center top-[68%] transition-transform duration-1000 transform">
        <h1 class="font-semibold text-3xl text-[#ffefd9]">Arsa & Nika</h1>
    </div>
    <button id="openButton" class="absolute bg-white text-[#3d1f17] py-2 px-4 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 z-10 transform -translate-x-1/2 -translate-y-1/2">
        Buka Undangan
    </button>

    <script>
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
    </script>

    <style>
        #openButton {
            top: 80%;
            left: 50%;
        }
    </style>
</body>

</html>