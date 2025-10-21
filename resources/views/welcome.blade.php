<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cuponera SV - Ahorra en grande</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background">
    <div class="min-h-screen relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-secondary/20 rounded-full blur-3xl"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-12">
            <div class="max-w-4xl w-full">
                <div class="text-center space-y-8">
                    <!-- Logo/Badge -->
                    <div class="flex justify-center animate-bounce">
                        <div class="relative">
                            <div class="w-24 h-24 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center shadow-2xl shadow-primary/50 transform rotate-3">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-xs text-white font-bold">%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Hero text -->
                    <div class="space-y-4">
                        <h1 class="text-5xl md:text-7xl font-bold text-white tracking-tight">
                            La Cuponera SV
                        </h1>
                        <p class="text-2xl md:text-3xl font-light text-primary">
                            Ahorra en grande 💰
                        </p>
                        <p class="text-lg text-textMuted max-w-2xl mx-auto">
                            Descubre cupones exclusivos, ofertas increíbles y promociones únicas en tus lugares favoritos de El Salvador.
                        </p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-8">
                        <a href="{{ route('login') }}" class="w-full sm:w-auto">
                            <button class="w-full sm:w-auto bg-primary hover:bg-primary/90 text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-primary/50 hover:shadow-xl hover:shadow-primary/70 transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Iniciar sesión
                            </button>
                        </a>
                        
                        <a href="{{ route('register') }}" class="w-full sm:w-auto">
                            <button class="w-full sm:w-auto bg-border hover:bg-border/80 text-white font-bold py-4 px-8 rounded-xl border-2 border-textMuted/20 hover:border-textMuted/40 transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Crear cuenta gratis
                            </button>
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 pt-16 max-w-3xl mx-auto">
                        <div class="bg-border/30 backdrop-blur-sm rounded-xl p-6 border border-textMuted/10 hover:border-primary/50 transition-colors">
                            <div class="text-4xl font-bold text-primary">500+</div>
                            <div class="text-sm text-textMuted mt-2">Cupones activos</div>
                        </div>
                        <div class="bg-border/30 backdrop-blur-sm rounded-xl p-6 border border-textMuted/10 hover:border-primary/50 transition-colors">
                            <div class="text-4xl font-bold text-primary">100+</div>
                            <div class="text-sm text-textMuted mt-2">Empresas aliadas</div>
                        </div>
                        <div class="bg-border/30 backdrop-blur-sm rounded-xl p-6 border border-textMuted/10 hover:border-primary/50 transition-colors">
                            <div class="text-4xl font-bold text-primary">50%</div>
                            <div class="text-sm text-textMuted mt-2">Ahorro promedio</div>
                        </div>
                        <div class="bg-border/30 backdrop-blur-sm rounded-xl p-6 border border-textMuted/10 hover:border-primary/50 transition-colors">
                            <div class="text-4xl font-bold text-primary">24/7</div>
                            <div class="text-sm text-textMuted mt-2">Disponibilidad</div>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="grid md:grid-cols-3 gap-6 pt-16 max-w-4xl mx-auto">
                        <div class="bg-border/20 backdrop-blur-sm rounded-2xl p-6 border border-textMuted/10 hover:border-primary/50 transition-all hover:scale-105">
                            <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-white font-bold mb-2">Verificado</h3>
                            <p class="text-textMuted text-sm">Todas las ofertas son verificadas y actualizadas constantemente</p>
                        </div>
                        <div class="bg-border/20 backdrop-blur-sm rounded-2xl p-6 border border-textMuted/10 hover:border-primary/50 transition-all hover:scale-105">
                            <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-white font-bold mb-2">Instantáneo</h3>
                            <p class="text-textMuted text-sm">Aplica tus cupones al instante sin complicaciones</p>
                        </div>
                        <div class="bg-border/20 backdrop-blur-sm rounded-2xl p-6 border border-textMuted/10 hover:border-primary/50 transition-all hover:scale-105">
                            <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="text-white font-bold mb-2">Seguro</h3>
                            <p class="text-textMuted text-sm">Tus datos están protegidos con la mejor tecnología</p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="pt-16 text-textMuted/60 text-sm">
                        <p>© 2024 La Cuponera SV. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>