<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="px-6 text-center md:px-12">
        <div class="flex items-center justify-center max-w-md mx-auto mb-8 ">
            <img src="{{ asset('/storage/assets/page-not-found-1.svg') }}" alt="404 Illustration" class="h-auto w-36">
        </div>

        <p class="mt-4 text-2xl font-semibold text-gray-700 md:text-3xl">Ooops, apa yang kamu cari tidak ditemukan</p>
        <p class="mt-2 text-gray-500">Halaman yang kamu cari tidak ditemukan, silahkan kembali ke halaman utama.</p>
        
        <a href="{{ url('/') }}" 
           class="inline-block px-6 py-3 mt-8 font-medium text-white transition-colors duration-200 bg-blue-500 rounded-full hover:bg-blue-600">
            kembali ke beranda
        </a>
    </div>
</body>
</html>

{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}
