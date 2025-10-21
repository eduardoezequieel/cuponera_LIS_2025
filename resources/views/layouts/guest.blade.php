@props(['title' => 'Página de invitado'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-white antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-6 sm:py-12 bg-background">
            <div class="flex relative flex-col items-center justify-center mb-6">
                <a href="/" class="group">
                     <div class="flex justify-center">
                        <div class="relative">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center shadow-2xl shadow-primary/50 transform rotate-3 group-hover:rotate-6 transition-transform duration-300">
                                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-5 h-5 sm:w-6 sm:h-6 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-xs text-white font-bold">%</span>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="space-y-2 text-center mt-4">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white tracking-tight">
                        La Cuponera SV
                    </h1>
                </div>
            </div>
            
            <div class="w-full sm:max-w-lg bg-secondary shadow-xl overflow-hidden sm:rounded-2xl border border-border/50">
                <div class="px-6 py-8 sm:px-8">
                    <h2 class="text-xl sm:text-2xl mb-6 text-center font-bold text-white">{{ $title }}</h2>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
