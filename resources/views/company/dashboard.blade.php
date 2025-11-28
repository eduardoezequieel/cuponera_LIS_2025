<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Panel de Empresa') }}
            </h2>
            <span class="text-sm text-textMuted">
                {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-emerald-600 to-green-700 rounded-xl shadow-lg p-6 border border-emerald-500/30">
                <div class="flex items-center gap-4">
                    <div class="bg-white/15 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">¡Bienvenido a tu Panel, {{ Auth::user()->name }}!</h3>
                        <p class="text-emerald-100">Gestiona tus cupones y ve el rendimiento de tu empresa</p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Mis Cupones -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-emerald-400/60 hover:shadow-emerald-500/20 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Mis Cupones</p>
                            <p class="text-3xl font-bold text-white mt-2">12</p>
                            <p class="text-emerald-400 text-xs mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                +3 este mes
                            </p>
                        </div>
                        <div class="bg-emerald-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Cupones Activos -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-emerald-400/60 hover:shadow-emerald-500/20 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Cupones Activos</p>
                            <p class="text-3xl font-bold text-white mt-2">8</p>
                            <p class="text-textMuted text-xs mt-2">2 por vencer pronto</p>
                        </div>
                        <div class="bg-emerald-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Canjes de Mis Cupones -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-emerald-400/60 hover:shadow-emerald-500/20 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Canjes del Mes</p>
                            <p class="text-3xl font-bold text-white mt-2">89</p>
                            <p class="text-emerald-400 text-xs mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                +15% vs mes anterior
                            </p>
                        </div>
                        <div class="bg-yellow-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Ingresos Estimados -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-emerald-400/60 hover:shadow-emerald-500/20 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Ingresos Estimados</p>
                            <p class="text-3xl font-bold text-white mt-2">$2,450</p>
                            <p class="text-orange-400 text-xs mt-2">Basado en canjes</p>
                        </div>
                        <div class="bg-purple-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Mis Cupones Populares -->
                <div class="lg:col-span-2 bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">🔥 Mis Cupones Más Populares</h3>
                        <a href="#" class="text-emerald-400 hover:text-emerald-300 text-sm font-medium transition-colors">Gestionar Cupones</a>
                    </div>
                    <div class="space-y-4">
                        <!-- Cupón 1 -->
                        <div class="flex items-center gap-4 p-4 bg-background rounded-lg border border-border hover:border-emerald-400/60 hover:shadow-emerald-500/10 transition-all duration-300">
                            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-white font-medium">50% descuento en Pizza Grande</h4>
                                <p class="text-textMuted text-sm">Tu Empresa</p>
                            </div>
                            <div class="text-right">
                                <p class="text-emerald-400 font-bold text-lg">50%</p>
                                <p class="text-textMuted text-xs">45 canjes</p>
                            </div>
                        </div>

                        <!-- Cupón 2 -->
                        <div class="flex items-center gap-4 p-4 bg-background rounded-lg border border-border hover:border-emerald-400/60 hover:shadow-emerald-500/10 transition-all duration-300">
                            <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-white font-medium">2x1 en Hamburguesas</h4>
                                <p class="text-textMuted text-sm">Tu Empresa</p>
                            </div>
                            <div class="text-right">
                                <p class="text-blue-400 font-bold text-lg">2x1</p>
                                <p class="text-textMuted text-xs">32 canjes</p>
                            </div>
                        </div>

                        <!-- Cupón 3 -->
                        <div class="flex items-center gap-4 p-4 bg-background rounded-lg border border-border hover:border-emerald-400/60 hover:shadow-emerald-500/10 transition-all duration-300">
                            <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-white font-medium">30% OFF en compras mayores a $50</h4>
                                <p class="text-textMuted text-sm">Tu Empresa</p>
                            </div>
                            <div class="text-right">
                                <p class="text-orange-400 font-bold text-lg">30%</p>
                                <p class="text-textMuted text-xs">28 canjes</p>
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
                            <div class="bg-emerald-500/20 p-2 rounded-full mt-1">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white text-sm">Cupón canjeado</p>
                                <p class="text-textMuted text-xs">Pizza Grande - Hace 5 min</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="bg-blue-500/20 p-2 rounded-full mt-1">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white text-sm">Nuevo cupón creado</p>
                                <p class="text-textMuted text-xs">2x1 Hamburguesas - Hace 2 horas</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="bg-orange-500/20 p-2 rounded-full mt-1">
                                <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white text-sm">Cupón por vencer</p>
                                <p class="text-textMuted text-xs">30% OFF - En 3 días</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="bg-purple-500/20 p-2 rounded-full mt-1">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white text-sm">Solicitud de aprobación</p>
                                <p class="text-textMuted text-xs">Cupón nuevo enviado - Hace 1 día</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white">⚡ Acciones Rápidas</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="#" class="bg-emerald-500/20 hover:bg-emerald-500/30 p-4 rounded-lg border border-emerald-500/50 hover:border-emerald-400 transition-all duration-300 text-center group">
                        <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">➕</div>
                        <p class="text-white font-medium">Crear Nuevo Cupón</p>
                    </a>
                    <a href="#" class="bg-blue-500/20 hover:bg-blue-500/30 p-4 rounded-lg border border-blue-500/50 hover:border-blue-400 transition-all duration-300 text-center group">
                        <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">📊</div>
                        <p class="text-white font-medium">Ver Reportes</p>
                    </a>
                    <a href="#" class="bg-purple-500/20 hover:bg-purple-500/30 p-4 rounded-lg border border-purple-500/50 hover:border-purple-400 transition-all duration-300 text-center group">
                        <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">⚙️</div>
                        <p class="text-white font-medium">Configurar Perfil</p>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>