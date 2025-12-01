<x-client-layout>
    <div class="space-y-4">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-white mb-1">Cupones Disponibles</h1>
            <p class="text-textMuted text-base">Descubre ofertas exclusivas y ahorra</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($coupons as $coupon)
                <div class="bg-background p-4 rounded-xl shadow-lg border border-border hover:border-primary transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-textMuted font-medium">{{ $coupon->quantity }} disponibles</span>
                        </div>
                    </div>

                    <h2 class="text-lg font-bold text-white mb-2 line-clamp-1">{{ $coupon->title }}</h2>
                    <p class="text-textMuted text-sm mb-3 line-clamp-2">{{ $coupon->description }}</p>

                    <div class="bg-border/20 rounded-lg p-3 mb-4">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-textMuted text-xs">Regular:</span>
                            <span class="text-textMuted line-through text-sm">${{ number_format($coupon->regular_price, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-textMuted text-xs">Oferta:</span>
                            <span class="text-xl font-bold text-primary">${{ number_format($coupon->offer_price, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-textMuted text-xs">Ahorro:</span>
                            <span class="text-green-400 font-semibold">{{ number_format((($coupon->regular_price - $coupon->offer_price) / $coupon->regular_price) * 100, 0) }}%</span>
                        </div>
                    </div>

                    <div class="mb-4 text-xs text-center">
                        <span class="text-textMuted">Válido del </span>
                        <span class="text-white font-medium">{{ $coupon->start_date->locale('es')->isoFormat('D [de] MMMM') }}</span>
                        <span class="text-textMuted"> al </span>
                        <span class="text-white font-medium">{{ $coupon->end_date->locale('es')->isoFormat('D [de] MMMM') }}</span>
                    </div>

                    <a href="{{ route('client.coupons.show', $coupon) }}" class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-1 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Ver Detalles
                    </a>
                </div>
            @endforeach
        </div>

        @if($coupons->isEmpty())
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-border rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-textMuted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-1">No hay cupones disponibles</h3>
                <p class="text-textMuted text-sm">Vuelve pronto para nuevas ofertas</p>
            </div>
        @endif

        @if($coupons->hasPages())
            <div class="mt-6">
                {{ $coupons->links() }}
            </div>
        @endif
    </div>
</x-client-layout>