<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Animation pour les cercles de fond */
            @keyframes orbit {
                from { transform: rotate(0deg) translateX(100px) rotate(0deg); }
                to   { transform: rotate(360deg) translateX(100px) rotate(-360deg); }
            }
            .animate-orbit {
                animation: orbit 20s linear infinite;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900 overflow-x-hidden">
        <div class="min-h-screen relative flex flex-col items-center justify-center bg-[#0f172a]">
            
            <div class="absolute top-0 -left-20 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 -right-20 w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-[120px]"></div>
            
            <div class="relative z-10 mb-8 transition-transform hover:scale-110 duration-500">
                <a href="/" class="flex flex-col items-center group">
                    <div class="p-4 bg-white/10 backdrop-blur-lg rounded-3xl border border-white/20 shadow-2xl group-hover:shadow-indigo-500/40 transition-all">
                        <x-application-logo class="w-16 h-16 fill-current text-white" />
                    </div>
                </a>
            </div>

            <div class="relative z-10 w-full px-4">
                {{ $slot }}
            </div>

            <div class="relative z-10 py-8 text-gray-500 text-sm font-medium">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Built for professionals.
            </div>
        </div>
    </body>
</html>