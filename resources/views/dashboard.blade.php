<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Panel de Control') }}
            </h2>
            <span class="text-sm text-textMuted">
                {{ now()->format('l, d \d\e F \d\e Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-primary to-primary/80 rounded-xl shadow-lg p-6 border border-primary/50">
                <div class="flex items-center gap-4">
                    <div class="bg-white/10 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">¡Bienvenido, {{ Auth::user()->name }}!</h3>
                        <p class="text-white/80">Aquí tienes un resumen de tu actividad en La Cuponera SV</p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Cupones -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-primary/50 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Total Cupones</p>
                            <p class="text-3xl font-bold text-white mt-2">24</p>
                            <p class="text-green-400 text-xs mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                +12% este mes
                            </p>
                        </div>
                        <div class="bg-primary/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Cupones Activos -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-primary/50 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Cupones Activos</p>
                            <p class="text-3xl font-bold text-white mt-2">18</p>
                            <p class="text-textMuted text-xs mt-2">6 por vencer pronto</p>
                        </div>
                        <div class="bg-green-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Canjes del Mes -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-primary/50 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Canjes del Mes</p>
                            <p class="text-3xl font-bold text-white mt-2">147</p>
                            <p class="text-green-400 text-xs mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                +28% vs mes anterior
                            </p>
                        </div>
                        <div class="bg-yellow-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Empresas Registradas -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-primary/50 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Empresas Activas</p>
                            <p class="text-3xl font-bold text-white mt-2">32</p>
                            <p class="text-orange-400 text-xs mt-2">5 pendientes de aprobación</p>
                        </div>
                        <div class="bg-purple-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Cupones Populares -->
                <div class="lg:col-span-2 bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">🔥 Cupones Más Populares</h3>
                        <a href="#" class="text-primary hover:text-primary/80 text-sm font-medium">Ver todos</a>
                    </div>
                    <div class="space-y-4">
                        <!-- Cupón 1 -->
                        <div class="flex items-center gap-4 p-4 bg-background rounded-lg border border-border hover:border-primary/50 transition-all">
                            <div class="bg-gradient-to-br from-primary to-primary/60 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-white font-medium">50% descuento en Pizza Grande</h4>
                                <p class="text-textMuted text-sm">Pizza Hut El Salvador</p>
                            </div>
                            <div class="text-right">
                                <p class="text-primary font-bold text-lg">50%</p>
                                <p class="text-textMuted text-xs">234 canjes</p>
                            </div>
                        </div>

                        <!-- Cupón 2 -->
                        <div class="flex items-center gap-4 p-4 bg-background rounded-lg border border-border hover:border-primary/50 transition-all">
                            <div class="bg-gradient-to-br from-green-500 to-green-600 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-white font-medium">2x1 en Hamburguesas</h4>
                                <p class="text-textMuted text-sm">Wendy's</p>
                            </div>
                            <div class="text-right">
                                <p class="text-green-500 font-bold text-lg">2x1</p>
                                <p class="text-textMuted text-xs">189 canjes</p>
                            </div>
                        </div>

                        <!-- Cupón 3 -->
                        <div class="flex items-center gap-4 p-4 bg-background rounded-lg border border-border hover:border-primary/50 transition-all">
                            <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-white font-medium">30% OFF en compras mayores a $50</h4>
                                <p class="text-textMuted text-sm">La Curacao</p>
                            </div>
                            <div class="text-right">
                                <p class="text-orange-500 font-bold text-lg">30%</p>
                                <p class="text-textMuted text-xs">156 canjes</p>
                            </div>
                        </div>

                        <!-- Cupón 4 -->
                        <div class="flex items-center gap-4 p-4 bg-background rounded-lg border border-border hover:border-primary/50 transition-all">
                            <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-white font-medium">Café Gratis con cualquier compra</h4>
                                <p class="text-textMuted text-sm">Starbucks</p>
                            </div>
                            <div class="text-right">
                                <p class="text-blue-500 font-bold text-lg">GRATIS</p>
                                <p class="text-textMuted text-xs">142 canjes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actividad Reciente -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">📊 Actividad Reciente</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="bg-green-500/20 p-2 rounded-full mt-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white text-sm">Cupón canjeado</p>
                                <p class="text-textMuted text-xs">Pizza Hut - Hace 2 min</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="bg-blue-500/20 p-2 rounded-full mt-1">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white text-sm">Nuevo cupón agregado</p>
                                <p class="text-textMuted text-xs">McDonald's - Hace 15 min</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="bg-purple-500/20 p-2 rounded-full mt-1">
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white text-sm">Nueva empresa registrada</p>
                                <p class="text-textMuted text-xs">Super Selectos - Hace 1 hora</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="bg-orange-500/20 p-2 rounded-full mt-1">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white text-sm">Cupón por vencer</p>
                                <p class="text-textMuted text-xs">Pollo Campero - En 2 días</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="bg-green-500/20 p-2 rounded-full mt-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white text-sm">Empresa aprobada</p>
                                <p class="text-textMuted text-xs">Subway - Hace 3 horas</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="bg-yellow-500/20 p-2 rounded-full mt-1">
                                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white text-sm">Cupón destacado</p>
                                <p class="text-textMuted text-xs">KFC - Hace 5 horas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categorías Populares -->
            <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white">🏷️ Categorías Más Populares</h3>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-background p-4 rounded-lg border border-border hover:border-primary/50 transition-all text-center">
                        <div class="text-3xl mb-2">🍕</div>
                        <p class="text-white font-medium">Comida</p>
                        <p class="text-textMuted text-sm">156 cupones</p>
                    </div>
                    <div class="bg-background p-4 rounded-lg border border-border hover:border-primary/50 transition-all text-center">
                        <div class="text-3xl mb-2">🛍️</div>
                        <p class="text-white font-medium">Retail</p>
                        <p class="text-textMuted text-sm">89 cupones</p>
                    </div>
                    <div class="bg-background p-4 rounded-lg border border-border hover:border-primary/50 transition-all text-center">
                        <div class="text-3xl mb-2">💆</div>
                        <p class="text-white font-medium">Belleza</p>
                        <p class="text-textMuted text-sm">67 cupones</p>
                    </div>
                    <div class="bg-background p-4 rounded-lg border border-border hover:border-primary/50 transition-all text-center">
                        <div class="text-3xl mb-2">🎮</div>
                        <p class="text-white font-medium">Entretenimiento</p>
                        <p class="text-textMuted text-sm">45 cupones</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
