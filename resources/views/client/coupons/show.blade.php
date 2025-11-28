<x-client-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-white mb-1">Detalles del Cupón</h1>
            <p class="text-textMuted text-base">Información completa del cupón seleccionado</p>
        </div>

        <div class="bg-background p-6 rounded-xl shadow-lg border border-border">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-16 h-16 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-white mb-2">{{ $coupon->title }}</h2>
                    <p class="text-textMuted text-base leading-relaxed">{{ $coupon->description }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-border/20 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-white mb-3">Precios</h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-textMuted">Precio Regular:</span>
                            <span class="text-textMuted line-through">${{ number_format($coupon->regular_price, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-textMuted">Precio Oferta:</span>
                            <span class="text-xl font-bold text-primary">${{ number_format($coupon->offer_price, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-textMuted">Ahorro:</span>
                            <span class="text-green-400 font-semibold">{{ number_format((($coupon->regular_price - $coupon->offer_price) / $coupon->regular_price) * 100, 0) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-border/20 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-white mb-3">Disponibilidad</h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-textMuted">Cantidad Disponible:</span>
                            <span class="text-white font-medium">{{ $coupon->quantity }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-border/20 rounded-lg p-4 mb-6">
                <h3 class="text-lg font-semibold text-white mb-3">Fechas Importantes</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="text-textMuted text-sm mb-1">Fecha de Inicio</div>
                        <div class="text-white font-medium">{{ $coupon->start_date->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-textMuted text-sm mb-1">Fecha de Fin</div>
                        <div class="text-white font-medium">{{ $coupon->end_date->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-textMuted text-sm mb-1">Fecha Límite de Canje</div>
                        <div class="text-white font-medium">{{ $coupon->redemption_deadline->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                @auth
                    @if(Auth::user()->hasRole('cliente'))
                        <a href="{{ route('client.coupons.purchase', $coupon) }}" class="flex-1 bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13v8a2 2 0 002 2h10a2 2 0 002-2v-3" />
                            </svg>
                            Comprar Cupón
                        </a>
                    @else
                        <div class="flex-1 bg-gray-600 text-gray-300 font-semibold py-3 px-6 rounded-lg flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            Solo clientes pueden comprar
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="flex-1 bg-secondary hover:bg-secondary/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Iniciar Sesión para Comprar
                    </a>
                @endauth
                <a href="{{ route('client.coupons.index') }}" class="bg-border hover:bg-border/80 text-textMuted hover:text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver a Cupones
                </a>
            </div>
        </div>
    </div>
</x-client-layout>