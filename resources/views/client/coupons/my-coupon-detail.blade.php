<x-client-layout>
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('client.my-coupons') }}" class="text-textMuted hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-white">Mi Cupón</h1>
                <p class="text-textMuted text-sm">Detalles de tu cupón comprado</p>
            </div>
        </div>

        @php
            $coupon = $purchase->coupon;
            $isExpired = $coupon->redemption_deadline->isPast();
        @endphp

        <!-- Código del Cupón - Destacado -->
        <div class="bg-gradient-to-br from-primary/20 to-secondary/20 rounded-2xl p-8 border-2 border-primary/50 shadow-2xl">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-primary to-secondary rounded-2xl mb-4 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
                <p class="text-textMuted text-sm uppercase tracking-widest mb-2">Tu Código Único</p>
                <p class="text-5xl font-bold text-white tracking-wider font-mono mb-4">{{ $purchase->unique_code }}</p>
                <p class="text-textMuted text-sm">Presenta este código en el establecimiento</p>
            </div>
        </div>

        <!-- Estado del Cupón -->
        <div class="bg-background rounded-xl shadow-lg border border-border p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    @if($isExpired)
                        <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-red-400">Cupón Expirado</h3>
                            <p class="text-textMuted text-sm">Este cupón ya no puede ser canjeado</p>
                        </div>
                    @else
                        <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-green-400">Cupón Activo</h3>
                            <p class="text-textMuted text-sm">Puedes canjear este cupón hasta la fecha límite</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Información del Cupón -->
        <div class="bg-background rounded-xl shadow-lg border border-border p-6">
            <h2 class="text-2xl font-bold text-white mb-4">{{ $coupon->title }}</h2>
            <p class="text-textMuted text-base leading-relaxed mb-6">{{ $coupon->description }}</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información de Compra -->
                <div class="bg-border/20 rounded-lg p-5">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Información de Compra
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-textMuted text-sm">Fecha de compra:</span>
                            <span class="text-white font-medium text-sm">{{ $purchase->purchase_date->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-textMuted text-sm">Precio pagado:</span>
                            <span class="text-primary font-bold text-lg">${{ number_format($coupon->offer_price, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-textMuted text-sm">Precio regular:</span>
                            <span class="text-textMuted line-through text-sm">${{ number_format($coupon->regular_price, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-border">
                            <span class="text-textMuted text-sm">Ahorro:</span>
                            <span class="text-green-400 font-semibold">${{ number_format($coupon->regular_price - $coupon->offer_price, 2) }} ({{ number_format((($coupon->regular_price - $coupon->offer_price) / $coupon->regular_price) * 100, 0) }}%)</span>
                        </div>
                    </div>
                </div>

                <!-- Fechas Importantes -->
                <div class="bg-border/20 rounded-lg p-5">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Fechas Importantes
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-textMuted text-sm">Válido desde:</span>
                            <span class="text-white font-medium text-sm">{{ $coupon->start_date->locale('es')->isoFormat('D/M/Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-textMuted text-sm">Válido hasta:</span>
                            <span class="text-white font-medium text-sm">{{ $coupon->end_date->locale('es')->isoFormat('D/M/Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-border">
                            <span class="text-textMuted text-sm">Canjear antes de:</span>
                            <span class="font-bold {{ $isExpired ? 'text-red-400' : 'text-primary' }} text-sm">{{ $coupon->redemption_deadline->locale('es')->isoFormat('D/M/Y') }}</span>
                        </div>
                        @if(!$isExpired)
                            <div class="bg-primary/10 border border-primary/30 rounded-lg p-3 mt-3">
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-primary mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-xs text-textMuted">
                                        Te quedan {{ $coupon->redemption_deadline->diffForHumans() }} para canjear este cupón
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Información de Pago -->
        @if(isset($purchase->payment_details['card_number']))
        <div class="bg-background rounded-xl shadow-lg border border-border p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                Método de Pago
            </h3>
            <div class="bg-border/20 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-medium">Tarjeta terminada en {{ $purchase->payment_details['card_number'] }}</p>
                            <p class="text-textMuted text-sm">{{ $purchase->payment_details['card_holder'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Instrucciones -->
        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 border border-primary/30 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-3">¿Cómo canjear tu cupón?</h3>
                    <ol class="text-sm text-textMuted space-y-2">
                        <li class="flex items-start gap-2">
                            <span class="text-primary font-bold">1.</span>
                            <span>Visita el establecimiento antes de la fecha límite de canje</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary font-bold">2.</span>
                            <span>Presenta tu código único <span class="font-mono font-bold text-white">{{ $purchase->unique_code }}</span></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary font-bold">3.</span>
                            <span>Disfruta de tu descuento o beneficio</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('client.my-coupons') }}" class="flex-1 bg-border hover:bg-border/80 text-textMuted hover:text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver a Mis Cupones
            </a>
            <a href="{{ route('client.coupons.index') }}" class="flex-1 bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Explorar Más Cupones
            </a>
        </div>
    </div>
</x-client-layout>
