<x-client-layout>
    <div class="max-w-6xl mx-auto space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-white mb-1">Comprar Cupón</h1>
            <p class="text-textMuted text-base">Completa la información de pago para adquirir tu cupón</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Purchase Form -->
            <div class="bg-background p-8 rounded-xl shadow-lg border border-border">
                <h3 class="text-xl font-bold text-white mb-8">Información de Pago</h3>
                <form method="POST" action="{{ route('client.coupons.store', $coupon) }}" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label for="card_number" :value="__('Número de Tarjeta')" />
                            <x-text-input id="card_number" class="block mt-1 w-full" type="text" name="card_number" placeholder="1234 5678 9012 3456" required maxlength="19" pattern="\d{4} ?\d{4} ?\d{4} ?\d{4}" />
                            <x-input-error :messages="$errors->get('card_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="expiry_month" :value="__('Mes de Expiración')" />
                            <x-select-input id="expiry_month" name="expiry_month" required>
                                <option value="">Seleccionar mes</option>
                                @for($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </x-select-input>
                            <x-input-error :messages="$errors->get('expiry_month')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="expiry_year" :value="__('Año de Expiración')" />
                            <x-select-input id="expiry_year" name="expiry_year" required>
                                <option value="">Seleccionar año</option>
                                @for($year = date('Y'); $year <= date('Y') + 10; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </x-select-input>
                            <x-input-error :messages="$errors->get('expiry_year')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="cvv" :value="__('CVV')" />
                            <x-text-input id="cvv" class="block mt-1 w-full" type="text" name="cvv" placeholder="123" required maxlength="4" pattern="\d{3,4}" />
                            <x-input-error :messages="$errors->get('cvv')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="card_holder" :value="__('Nombre en la Tarjeta')" />
                            <x-text-input id="card_holder" class="block mt-1 w-full" type="text" name="card_holder" placeholder="Juan Pérez" required />
                            <x-input-error :messages="$errors->get('card_holder')" class="mt-2" />
                        </div>
                    </div>

                    <div class="bg-border/20 rounded-lg p-6">
                        <div class="flex items-center justify-between text-white">
                            <span class="font-medium">Total a Pagar:</span>
                            <span class="text-2xl font-bold text-primary">${{ number_format($coupon->offer_price, 2) }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="flex-1 bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Completar Compra
                        </button>
                        <a href="{{ route('client.coupons.show', $coupon) }}" class="bg-border hover:bg-border/80 text-textMuted hover:text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Coupon Details -->
            <div class="bg-background p-8 rounded-xl shadow-lg border border-border">
                <div class="flex items-start gap-4 mb-8">
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-border/20 rounded-lg p-6">
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

                    <div class="bg-border/20 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-white mb-3">Disponibilidad</h3>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-textMuted">Cantidad Disponible:</span>
                                <span class="text-white font-medium">{{ $coupon->quantity }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-border/20 rounded-lg p-6">
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
            </div>
        </div>
    </div>
</x-client-layout>

<script>        
    document.addEventListener('DOMContentLoaded', () => {
        console.log('Initializing input masks for payment form', window.IMask);
        const cardNumberInput = document.getElementById('card_number');
        const cvvInput = document.getElementById('cvv');

        console.log({cardNumberInput, cvvInput});
        
        if (cardNumberInput && window.IMask) {
            const maskOptions = {
                mask: '0000-0000-0000-0000',
                lazy: false,
            };
            
            const mask = window.IMask(cardNumberInput, maskOptions);
        }

        if (cvvInput && window.IMask) {
            const maskOptions = {
                mask: '0000',
                lazy: false,
            };
            
            const mask = window.IMask(cvvInput, maskOptions);
        }
    });
</script>