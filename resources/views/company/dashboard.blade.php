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
                <!-- Total Cupones -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-emerald-400/60 hover:shadow-emerald-500/20 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Total Cupones</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ number_format($totalCoupons) }}</p>
                            <p class="text-textMuted text-xs mt-2">{{ $activeCoupons }} activos</p>
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
                            <p class="text-3xl font-bold text-white mt-2">{{ number_format($activeCoupons) }}</p>
                            @if($expiringCoupons > 0)
                                <p class="text-orange-400 text-xs mt-2">{{ $expiringCoupons }} por vencer pronto</p>
                            @else
                                <p class="text-emerald-400 text-xs mt-2">Ninguno por vencer</p>
                            @endif
                        </div>
                        <div class="bg-blue-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Ventas del Mes -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-emerald-400/60 hover:shadow-emerald-500/20 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Ventas del Mes</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ number_format($salesThisMonth) }}</p>
                            @if($salesLastMonth > 0)
                                @php
                                    $percentageChange = (($salesThisMonth - $salesLastMonth) / $salesLastMonth) * 100;
                                @endphp
                                <p class="{{ $percentageChange >= 0 ? 'text-emerald-400' : 'text-red-400' }} text-xs mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $percentageChange >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}" />
                                    </svg>
                                    {{ number_format(abs($percentageChange), 1) }}% vs mes anterior
                                </p>
                            @else
                                <p class="text-textMuted text-xs mt-2">Sin comparación</p>
                            @endif
                        </div>
                        <div class="bg-yellow-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Ingresos del Mes -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-emerald-400/60 hover:shadow-emerald-500/20 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Ingresos del Mes</p>
                            <p class="text-3xl font-bold text-white mt-2">${{ number_format($revenueThisMonth, 2) }}</p>
                            <p class="text-textMuted text-xs mt-2">Total: ${{ number_format($totalRevenue, 2) }}</p>
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
                <!-- Cupones Más Vendidos -->
                <div class="lg:col-span-2 bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">🔥 Cupones Más Vendidos</h3>
                        <a href="{{ route('company.coupons.index') }}" class="text-emerald-400 hover:text-emerald-300 text-sm font-medium transition-colors">Ver Todos</a>
                    </div>
                    @if($topCoupons->count() > 0)
                        <div class="space-y-4">
                            @foreach($topCoupons as $coupon)
                                <div class="flex items-center gap-4 p-4 bg-background rounded-lg border border-border hover:border-emerald-400/60 hover:shadow-emerald-500/10 transition-all duration-300">
                                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-3 rounded-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-white font-medium">{{ $coupon->title }}</h4>
                                        <p class="text-textMuted text-sm">${{ number_format($coupon->offer_price, 2) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-emerald-400 font-bold text-lg">{{ $coupon->purchases_count }}</p>
                                        <p class="text-textMuted text-xs">ventas</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-textMuted mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            <p class="text-textMuted">Aún no tienes cupones creados</p>
                            <a href="{{ route('company.coupons.create') }}" class="inline-flex items-center gap-2 mt-4 text-emerald-400 hover:text-emerald-300 transition-colors">
                                Crear primer cupón
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Actividad Reciente -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">📊 Actividad Reciente</h3>
                    </div>
                    @if($recentActivity->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentActivity as $purchase)
                                <div class="flex items-start gap-3">
                                    <div class="bg-emerald-500/20 p-2 rounded-full mt-1">
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white text-sm">
                                            <span class="font-medium">{{ $purchase->user->name }}</span> compró cupón
                                        </p>
                                        <p class="text-textMuted text-xs">{{ $purchase->coupon->title }} - {{ $purchase->purchase_date->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-textMuted mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-textMuted text-sm">No hay actividad reciente</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white">⚡ Acciones Rápidas</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('company.coupons.create') }}" class="bg-emerald-500/20 hover:bg-emerald-500/30 p-4 rounded-lg border border-emerald-500/50 hover:border-emerald-400 transition-all duration-300 text-center group">
                        <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">➕</div>
                        <p class="text-white font-medium">Crear Nuevo Cupón</p>
                    </a>
                    <a href="{{ route('company.coupons.index') }}" class="bg-blue-500/20 hover:bg-blue-500/30 p-4 rounded-lg border border-blue-500/50 hover:border-blue-400 transition-all duration-300 text-center group">
                        <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">📊</div>
                        <p class="text-white font-medium">Gestionar Cupones</p>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="bg-purple-500/20 hover:bg-purple-500/30 p-4 rounded-lg border border-purple-500/50 hover:border-purple-400 transition-all duration-300 text-center group">
                        <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">⚙️</div>
                        <p class="text-white font-medium">Configurar Perfil</p>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>