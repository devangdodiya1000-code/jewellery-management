<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#0A0A0A] text-[#FDFDFC]">
            <div class="mb-6">
                <a href="/" class="inline-flex items-center justify-center">
                    <x-application-logo class="w-20 h-20 fill-current text-[#D4AF37]" />
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-6 bg-[#0f0e0c] shadow-[inset_0px_0px_0px_1px_rgba(212,175,55,0.18)] border border-[rgba(212,175,55,0.22)] rounded-lg">
                <div class="mb-5">
                    <div class="h-px w-14 bg-[rgba(212,175,55,0.65)] mb-3 mx-auto" aria-hidden="true"></div>
                    <h1 class="text-center font-medium" style="color:#EDE3CE;">{{ config('app.name', 'Aurum') }}</h1>
                    <p class="text-center text-[11px]" style="color:rgba(255,255,255,0.55); letter-spacing:2.5px; text-transform:uppercase;">Welcome</p>
                </div>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
