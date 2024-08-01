<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
 
        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
        <title>{{ config('app.name') }}</title>
 
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
 
        @filamentStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
 
    <body class="antialiased">
        <div class="bg-slate-700 w-full p-4">
            <h1 class="text-3xl font-light">Comming Soon, dab!</h1> 
        </div>
        
        @filamentScripts
    </body>
</html>