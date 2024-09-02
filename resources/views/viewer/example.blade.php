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
        .bg-custom {
            background-image: url('{{ asset('/storage/asset-invitation/javanese-gunungan-1.png') }}');
            /* background-size: 80%; */
            /* background-position: center; */
            /* background-repeat: no-repeat; */
        }
    </style>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-[#3d1f17]">
    <img class="heldef inset-0 fixed top-[15%] scale-[85%] opacity-10" src="{{ asset('/storage/asset-invitation/javanese-gunungan-1.png') }}" alt="">
    <section id="quote">
        <div class="relative flex items-center justify-center h-screen px-10">
            <img class="absolute top-0 translate-y-5 w-36 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-hr.png') }}" alt="">
            <img class="absolute bottom-0 w-36 -translate-y-5 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-hr.png') }}" alt="">
            <img class="absolute left-0 h-[70%] translate-x-3 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-vr.png') }}" alt="">
            <img class="absolute right-0 h-[70%] -translate-x-3 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-vr.png') }}" alt="">
            <div class="ornament-behav-left overflow-hidden absolute left-0 top-0">
                <img class="size-40 -translate-x-9 -translate-y-10 rotate-[140deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-left overflow-hidden absolute left-0 bottom-0">
                <img class="size-40 -translate-x-10 translate-y-8 rotate-[47deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-right overflow-hidden absolute right-0 top-0">
                <img class="size-40 translate-x-10 -translate-y-9 -rotate-[135deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-right overflow-hidden absolute right-0 bottom-0">
                <img class="size-40 translate-x-9 translate-y-9 -rotate-[42deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <h1 class="hel1 text-white text-center">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam itaque nobis nihil provident vitae veritatis necessitatibus obcaecati hic autem optio voluptas facilis nesciunt possimus, neque tempore ad corporis magnam libero.
            </h1>
        </div>
    </section>
    <section id="bride-groom">
        <div class="relative flex items-center justify-center h-screen px-8">
            <img class="absolute top-0 translate-y-5 w-36 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-hr.png') }}" alt="">
            <img class="absolute bottom-0 w-36 -translate-y-5 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-hr.png') }}" alt="">
            <img class="absolute left-0 h-[70%] translate-x-3 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-vr.png') }}" alt="">
            <img class="absolute right-0 h-[70%] -translate-x-3 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-vr.png') }}" alt="">
            <div class="ornament-behav-left overflow-hidden absolute left-0 top-0">
                <img class="size-40 -translate-x-9 -translate-y-10 rotate-[140deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-left overflow-hidden absolute left-0 bottom-0">
                <img class="size-40 -translate-x-10 translate-y-8 rotate-[47deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-right overflow-hidden absolute right-0 top-0">
                <img class="size-40 translate-x-10 -translate-y-9 -rotate-[135deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-right overflow-hidden absolute right-0 bottom-0">
                <img class="size-40 translate-x-9 translate-y-9 -rotate-[42deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>

            <!-- konten -->
            <div class="hel1 z-20 flex flex-col items-center justify-center text-center text-white pb-10">
                <h1 class="text-xl font-semibold text-center">
                    Bride & Groom
                </h1>
                <p class="text-xs mt-5 leading-5">
                    Tuhan membuat segala sesuatu indah pada waktu-Nya
                    Indah ketika Ia mempertemukan kami
                    Indah ketika Ia menumbuhkan kasih di antara kami. 
                </p>
                <div class="mt-4">
                    <img class="h-24 w-auto" src="{{ asset('/storage/asset-invitation/javanese-wayang-1.png') }}" alt="">
                </div>
                <h1 class="text-xl font-bold mt-2">
                    Jan Arsa Widjaya
                </h1>
                <p class="text-xs mt-1">
                    Putra dari Bapak Widjaya  dan Ibu Sari Atmadja  
                </p>
                <p class="text-xs mt-3 font-semibold">dengan</p>
                <div class="mt-4">
                    <img class="h-24 w-auto" src="{{ asset('/storage/asset-invitation/javanese-wayang-2.png') }}" alt="">
                </div>
                <h1 class="text-xl font-bold mt-2">
                    Jan Arsa Widjaya
                </h1>
                <p class="text-xs mt-1">
                    Putra dari Bapak Widjaya  dan Ibu Sari Atmadja  
                </p>
            </div>
        </div>
    </section>
    <section id="event">
        <div class="relative flex items-center justify-center h-screen px-8">
            <img class="absolute top-0 translate-y-5 w-36 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-hr.png') }}" alt="">
            <img class="absolute bottom-0 w-36 -translate-y-5 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-hr.png') }}" alt="">
            <img class="absolute left-0 h-[70%] translate-x-3 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-vr.png') }}" alt="">
            <img class="absolute right-0 h-[70%] -translate-x-3 ornament-behav-line" src="{{ asset('/storage/asset-invitation/javanese-line-vr.png') }}" alt="">
            <div class="ornament-behav-left overflow-hidden absolute left-0 top-0">
                <img class="size-40 -translate-x-9 -translate-y-10 rotate-[140deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-left overflow-hidden absolute left-0 bottom-0">
                <img class="size-40 -translate-x-10 translate-y-8 rotate-[47deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-right overflow-hidden absolute right-0 top-0">
                <img class="size-40 translate-x-10 -translate-y-9 -rotate-[135deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-right overflow-hidden absolute right-0 bottom-0">
                <img class="size-40 translate-x-9 translate-y-9 -rotate-[42deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>

            <!-- konten -->
            <div class="hel1 z-20 flex flex-col items-center justify-center text-center text-white pb-10">
                <h1 class="text-2xl font-semibold text-center">
                    Event
                </h1>
                <div class="w-full mt-5 py-4 px-10 text-center bg-white text-white bg-opacity-30 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-xl font-semibold dark:text-white">Pemberkatan</h5>
                    <div class="flex flex-row items-center justify-center gap-x-4 mt-5">
                        <div class="w-1/3 border-2 border-l-0 border-r-0">
                            <h1 class="text-lg">Sabtu</h1>
                        </div>
                        <div class="w-1/3">
                            <h1 class="text-3xl font-bold">14</h1>
                        </div>
                        <div class="w-1/3 border-2 border-l-0 border-r-0">
                            <h1 class="text-lg">September</h1>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-5 text-sm gap-x-2">
                        <ion-icon class="text-lg" name="time-outline"></ion-icon>
                        <span>08:30 WIB</span>
                    </div>
                    <h1 class="mt-3">Gereja Katedral Jakarta</h1>
                    <button type="button" class="mt-5 text-slate-700 gap-x-2 bg-[#f7b93c] hover:bg-[#050708]/90 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#050708]/50 dark:hover:bg-[#050708]/30 me-2 mb-2">
                        <ion-icon class="text-lg" name="map-outline"></ion-icon>
                        Klik Maps
                    </button>
                </div>
                <div class="w-full mt-5 py-4 px-10 text-center bg-white text-white bg-opacity-30 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-xl font-semibold dark:text-white">Resepsi</h5>
                    <div class="flex flex-row items-center justify-center gap-x-4 mt-5">
                        <div class="w-1/3 border-2 border-l-0 border-r-0">
                            <h1 class="text-lg">Sabtu</h1>
                        </div>
                        <div class="w-1/3">
                            <h1 class="text-3xl font-bold">14</h1>
                        </div>
                        <div class="w-1/3 border-2 border-l-0 border-r-0">
                            <h1 class="text-lg">September</h1>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-5 text-sm gap-x-2">
                        <ion-icon class="text-lg" name="time-outline"></ion-icon>
                        <span>11:00 WIB</span>
                    </div>
                    <h1 class="mt-3">Kempinski Grand Ballroom</h1>
                    <button type="button" class="mt-5 text-slate-700 gap-x-2 bg-[#f7b93c] hover:bg-[#050708]/90 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#050708]/50 dark:hover:bg-[#050708]/30 me-2 mb-2">
                        <ion-icon class="text-lg" name="map-outline"></ion-icon>
                        Klik Maps
                    </button>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="flex flex-col overflow-x-hidden mx-auto px-10 bg-[#3d1f17] scroll-smooth">
        <div class="heldef inset-0 fixed flex mx-auto my-auto items-center opacity-10 size-[60%] md:size-[25%]">
            <img src="{{ asset('/storage/asset-invitation/javanese-gunungan-1.png') }}" alt="">
        </div>
        
        <div id="hel1" class="w-full flex flex-col h-screen items-center justify-center">
            <div class="ornament-behav-left overflow-hidden absolute left-0 top-0">
                <img class="size-40 -translate-x-8 -translate-y-9 rotate-[135deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-right overflow-hidden absolute right-0 top-0">
                <img class="size-40 translate-x-10 -translate-y-8 -rotate-[135deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-left overflow-hidden absolute left-0 bottom-0">
                <img class="size-40 -translate-x-10 translate-y-8 rotate-[45deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-right overflow-hidden absolute right-0 bottom-0">
                <img class="size-40 translate-x-7 translate-y-9 -rotate-[45deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>

            <div class="ornament-behav-line overflow-hidden absolute top-0 translate-y-5">
                <img class="w-36" src="{{ asset('/storage/asset-invitation/javanese-line-hr.png') }}" alt="">
            </div>
            <div class="ornament-behav-line overflow-hidden absolute bottom-0 -translate-y-7">
                <img class="w-36" src="{{ asset('/storage/asset-invitation/javanese-line-hr.png') }}" alt="">
            </div>
            <div class="ornament-behav-line overflow-hidden absolute left-0 translate-x-3">
                <img class="h-[450px]" src="{{ asset('/storage/asset-invitation/javanese-line-vr.png') }}" alt="">
            </div>
            <div class="ornament-behav-line overflow-hidden absolute right-0 -translate-x-3">
                <img class="h-[450px]" src="{{ asset('/storage/asset-invitation/javanese-line-vr.png') }}" alt="">
            </div>

            <h1 class="hel1 z-10 px-5 leading-10 text-lg text-center text-white">
                “Love recognises no barriers, 
                it jumps hurdles, leaps fences, 
                penetrates walls to arrive 
                at its destination, full of hope.”
            </h1>
        </div>
        <div class="relative w-full flex flex-col h-screen items-center justify-center">
            <div class="ornament-behav-left overflow-hidden absolute left-0 top-0">
                <img class="size-40 -translate-x-8 -translate-y-9 rotate-[135deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-right overflow-hidden absolute right-0 top-0">
                <img class="size-40 translate-x-10 -translate-y-8 -rotate-[135deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-left overflow-hidden absolute left-0 bottom-0">
                <img class="size-40 -translate-x-10 translate-y-8 rotate-[45deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>
            <div class="ornament-behav-right overflow-hidden absolute right-0 bottom-0">
                <img class="size-40 translate-x-7 translate-y-9 -rotate-[45deg]" src="{{ asset('/storage/asset-invitation/javanese-leaf.png') }}" alt="">
            </div>

            <div class="ornament-behav-line overflow-hidden absolute top-0 translate-y-5">
                <img class="w-36" src="{{ asset('/storage/asset-invitation/javanese-line-hr.png') }}" alt="">
            </div>
            <div class="ornament-behav-line overflow-hidden absolute bottom-0 -translate-y-7">
                <img class="w-36" src="{{ asset('/storage/asset-invitation/javanese-line-hr.png') }}" alt="">
            </div>
            <div class="ornament-behav-line overflow-hidden absolute left-0 translate-x-3">
                <img class="h-[450px]" src="{{ asset('/storage/asset-invitation/javanese-line-vr.png') }}" alt="">
            </div>
            <div class="ornament-behav-line overflow-hidden absolute right-0 -translate-x-3">
                <img class="h-[450px]" src="{{ asset('/storage/asset-invitation/javanese-line-vr.png') }}" alt="">
            </div>

            <h1 class="hel1 z-10 px-5 leading-10 text-lg text-center text-white">
                “Love recognises no barriers, 
                it jumps hurdles, leaps fences, 
                penetrates walls to arrive 
                at its destination, full of hope.”
            </h1>
        </div>
    </div> --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>