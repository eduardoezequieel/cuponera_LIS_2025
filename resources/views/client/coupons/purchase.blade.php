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
                            <div class="flex items-center justify-between mb-2">
                                <x-input-label for="card_number" :value="__('Número de Tarjeta')" />
                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-textMuted">Aceptamos:</span>
                                    <div class="flex gap-1">
                                        <svg class="w-8 h-6" viewBox="0 0 48 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="48" height="32" rx="4" fill="#1434CB"/>
                                            <path d="M20.5 11L17 21h-2.5l-2-7.7c-.1-.5-.3-.7-.7-.9-.7-.3-1.8-.6-2.8-.8L9 11h4.1c.5 0 1 .4 1.1.9l1 5.3 2.5-6.2h2.8zm11.1 6.7c0-2.6-3.6-2.8-3.6-4 0-.4.4-.8 1.2-.9.4 0 1.5-.1 2.7.5l.5-2.3c-.7-.2-1.5-.5-2.6-.5-2.8 0-4.7 1.5-4.7 3.6 0 1.5 1.4 2.4 2.4 2.9 1 .5 1.4.8 1.4 1.3 0 .7-.9 1-1.7 1-1.4 0-2.2-.4-2.9-.7l-.5 2.4c.7.3 1.9.5 3.1.5 3 0 4.9-1.5 4.9-3.8zm7.3 3.3h2.5l-2.2-10h-2.3c-.5 0-.9.3-1.1.7l-3.9 9.3h2.8l.6-1.5h3.4l.2 1.5zm-3-3.6l1.4-3.8.8 3.8h-2.2zm-10.4-6.4l-2.2 10h-2.7l2.2-10h2.7z" fill="white"/>
                                        </svg>
                                        <svg class="w-8 h-6" viewBox="0 0 48 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="48" height="32" rx="4" fill="#EB001B"/>
                                            <circle cx="19" cy="16" r="9" fill="#FF5F00"/>
                                            <circle cx="29" cy="16" r="9" fill="#F79E1B"/>
                                            <path d="M24 9.5c-1.7 1.4-2.8 3.6-2.8 6s1.1 4.6 2.8 6c1.7-1.4 2.8-3.6 2.8-6s-1.1-4.6-2.8-6z" fill="#FF5F00"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <x-text-input id="card_number" class="block mt-1 w-full" type="text" name="card_number" :value="old('card_number')" required autofocus autocomplete="card_number" />
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
                            <x-text-input id="cvv" class="block mt-1 w-full" type="text" name="cvv" :value="old('cvv')" required autofocus autocomplete="cvv" />
                            <x-input-error :messages="$errors->get('cvv')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="card_holder" :value="__('Nombre en la Tarjeta')" />
                            <x-text-input id="card_holder" class="block mt-1 w-full" type="text" name="card_holder" placeholder="Juan Pérez" required />
                            <x-input-error :messages="$errors->get('card_holder')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="quantity" :value="__('Cantidad de Cupones')" />
                            <x-select-input id="quantity" name="quantity" required>
                                @php
                                    $maxQuantity = min(5, $coupon->quantity);
                                @endphp
                                @for($i = 1; $i <= $maxQuantity; $i++)
                                    <option value="{{ $i }}" {{ old('quantity', 1) == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'cupón' : 'cupones' }}</option>
                                @endfor
                            </x-select-input>
                            <p class="text-xs text-textMuted mt-1">Máximo 5 cupones por promoción</p>
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>
                    </div>

                    <div class="bg-border/20 rounded-lg p-6">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-white">
                                <span class="text-textMuted">Precio por cupón:</span>
                                <span class="font-medium">${{ number_format($coupon->offer_price, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between text-white">
                                <span class="text-textMuted">Cantidad:</span>
                                <span id="display-quantity" class="font-medium">1</span>
                            </div>
                            <div class="border-t border-border pt-2 mt-2">
                                <div class="flex items-center justify-between text-white">
                                    <span class="font-medium">Total a Pagar:</span>
                                    <span id="total-price" class="text-2xl font-bold text-primary">${{ number_format($coupon->offer_price, 2) }}</span>
                                </div>
                            </div>
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
        const quantitySelect = document.getElementById('quantity');
        const displayQuantity = document.getElementById('display-quantity');
        const totalPrice = document.getElementById('total-price');
        const pricePerCoupon = {{ $coupon->offer_price }};

        console.log({cardNumberInput, cvvInput});
        
        if (cardNumberInput && window.IMask) {
            const maskOptions = {
                mask: '0000 0000 0000 0000',
                lazy: false,
            };
            
            const mask = window.IMask(cardNumberInput, maskOptions);
        }

        if (cvvInput && window.IMask) {
            const maskOptions = {
                mask: '000',
                lazy: false,
            };
            
            const mask = window.IMask(cvvInput, maskOptions);
        }

        // Actualizar total cuando cambia la cantidad
        if (quantitySelect) {
            quantitySelect.addEventListener('change', () => {
                const quantity = parseInt(quantitySelect.value);
                const total = pricePerCoupon * quantity;
                
                displayQuantity.textContent = quantity;
                totalPrice.textContent = '$' + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            });
        }
    });
</script>