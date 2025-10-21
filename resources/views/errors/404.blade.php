<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-white antialiased bg-background">
    <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-6 sm:py-12">
        <!-- Logo -->
        <div class="flex relative flex-col items-center justify-center mb-8">
            <a href="/" class="group">
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center shadow-2xl shadow-primary/50 transform rotate-3 group-hover:rotate-6 transition-transform duration-300">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="absolute -top-2 -right-2 w-5 h-5 sm:w-6 sm:h-6 bg-red-500 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-xs text-white font-bold">!</span>
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

        <!-- 404 Content -->
        <div class="w-full sm:max-w-md bg-secondary shadow-xl overflow-hidden sm:rounded-2xl border border-border/50">
            <div class="px-6 py-8 flex flex-col gap-5 sm:px-8 text-center">
                <!-- 404 Number -->
                <div class="mb-6">
                    <h2 class="text-8xl sm:text-9xl font-bold text-primary opacity-20">404</h2>
                </div>

                <!-- Error Message -->
                <div class="space-y-4">
                    <h3 class="text-2xl sm:text-3xl font-bold text-white">
                        Página no encontrada
                    </h3>
                    <p class="text-textMuted text-base">
                        Lo sentimos, la página que buscas no existe o ha sido movida.
                    </p>
                </div>

                <!-- Icon -->
                <div class="my-8">
                    <div class="w-24 h-24 mx-auto bg-border/30 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-textMuted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col gap-5">
                    <a href="{{ url('/') }}" class="block">
                        <button class="w-full inline-flex items-center justify-center gap-2 px-8 py-4 text-base bg-primary hover:bg-primary/90 text-white font-bold rounded-xl shadow-lg shadow-primary/50 hover:shadow-xl hover:shadow-primary/70 transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Volver al inicio
                        </button>
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="block">
                            <button class="w-full inline-flex items-center justify-center gap-2 px-8 py-4 text-base bg-border hover:bg-border/80 text-white font-bold rounded-xl border-2 border-textMuted/20 hover:border-textMuted/40 transform hover:scale-105 transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                Ir al Dashboard
                            </button>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block">
                            <button class="w-full inline-flex items-center justify-center gap-2 px-8 py-4 text-base bg-border hover:bg-border/80 text-white font-bold rounded-xl border-2 border-textMuted/20 hover:border-textMuted/40 transform hover:scale-105 transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Iniciar sesión
                            </button>
                        </a>
                    @endauth
                </div>

                <!-- Help text -->
                <div class="mt-8 pt-6 border-t border-border/50">
                    <p class="text-sm text-textMuted/60">
                        Si crees que esto es un error, <a href="{{ url('/') }}" class="text-primary hover:text-primary/80 underline">contáctanos</a>.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-textMuted/60 text-sm text-center">
            <p>© 2024 La Cuponera SV. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>