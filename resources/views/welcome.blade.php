<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
        {{-- Midtrans --}}
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-s9t2Tqf5BY_zW7qZ"></script>

        @vite('resources/css/app.css')
    </head>
    <body>
        {{ $slot }}
    </body>
</html>
