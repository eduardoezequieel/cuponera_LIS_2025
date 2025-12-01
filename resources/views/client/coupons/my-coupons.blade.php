<x-client-layout>
    <div class="max-w-7xl mx-auto space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-white mb-1">Mis Cupones</h1>
            <p class="text-textMuted text-base">Aquí puedes ver todos los cupones que has comprado</p>
        </div>

        @if($purchases->isEmpty())
            <div class="bg-background rounded-xl shadow-lg border border-border p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-textMuted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                <h3 class="text-xl font-semibold text-white mb-2">No tienes cupones aún</h3>
                <p class="text-textMuted mb-6">Explora nuestras ofertas y comienza a ahorrar</p>
                <a href="{{ route('client.coupons.index') }}" class="inline-flex items-center px-6 py-3 bg-primary hover:bg-primary/90 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Ver Cupones Disponibles
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($purchases as $purchase)
                    <div class="bg-background rounded-xl shadow-lg border border-border overflow-hidden hover:border-primary transition-all duration-300 hover:shadow-xl">
                        <div class="p-6">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center flex-shrink-0 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-white mb-1 truncate">{{ $purchase->coupon->title }}</h3>
                                    <p class="text-sm text-textMuted">
                                        Comprado el {{ $purchase->purchase_date->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                                    </p>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-primary/20 to-secondary/20 rounded-lg p-4 mb-4 border border-primary/30">
                                <div class="text-center">
                                    <p class="text-xs text-textMuted mb-1 uppercase tracking-wide">Código Único</p>
                                    <p class="text-2xl font-bold text-primary tracking-wider font-mono">{{ $purchase->unique_code }}</p>
                                </div>
                            </div>

                            <div class="bg-border/20 rounded-lg p-4 mb-4">
                                <div class="space-y-2 text-sm">
                                    <div class="flex items-center justify-between">
                                        <span class="text-textMuted">Precio pagado:</span>
                                        <span class="font-semibold text-white">${{ number_format($purchase->coupon->offer_price, 2) }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-textMuted">Canjear hasta:</span>
                                        <span class="font-semibold text-white">{{ $purchase->coupon->redemption_deadline->locale('es')->isoFormat('D/M/Y') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between pt-2 border-t border-border">
                                        <span class="text-textMuted">Estado:</span>
                                        @php
                                            $now = now();
                                            $isExpired = $purchase->coupon->redemption_deadline->isPast();
                                        @endphp
                                        @if($isExpired)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-400">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                                Expirado
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-500/20 text-green-400">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Activo
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('client.my-coupon.show', $purchase->id) }}" class="block w-full text-center bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors">
                                Ver Mi Cupón
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-gradient-to-r from-primary/10 to-secondary/10 border border-primary/30 rounded-xl p-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-white mb-2">Información importante</h3>
                        <ul class="text-sm text-textMuted space-y-1">
                            <li>• Presenta tu código único en el establecimiento para canjear tu cupón</li>
                            <li>• Los cupones solo son válidos hasta la fecha límite de canje</li>
                            <li>• Cada código puede usarse una sola vez</li>
                            <li>• Máximo 5 cupones por promoción</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if($purchases->hasPages())
            <div class="mt-6">
                {{ $purchases->links() }}
            </div>
        @endif
    </div>
</x-client-layout>
