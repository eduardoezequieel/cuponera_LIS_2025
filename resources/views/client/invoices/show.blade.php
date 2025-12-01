<x-client-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('client.invoices') }}" class="text-textMuted hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-white">Factura #{{ str_pad($purchase->id, 6, '0', STR_PAD_LEFT) }}</h1>
                <p class="text-textMuted text-sm">Detalles de tu compra</p>
            </div>
        </div>

        <!-- Factura -->
        <div class="bg-background rounded-xl shadow-lg border border-border overflow-hidden">
            <!-- Header de la Factura -->
            <div class="bg-gradient-to-r from-primary to-secondary p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">{{ config('app.name') }}</h2>
                                <p class="text-white/80 text-sm">Sistema de Cupones</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-white/80 text-sm mb-1">Factura</p>
                        <p class="text-2xl font-bold text-white">#{{ str_pad($purchase->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>

            <!-- Información de la Factura -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Información del Cliente -->
                    <div class="bg-border/20 rounded-lg p-5">
                        <h3 class="text-sm font-semibold text-textMuted uppercase tracking-wide mb-3">Facturado A:</h3>
                        <div class="space-y-1">
                            <p class="text-white font-medium">{{ Auth::user()->fullname }}</p>
                            <p class="text-textMuted text-sm">{{ Auth::user()->email }}</p>
                            @if(Auth::user()->phone)
                                <p class="text-textMuted text-sm">{{ Auth::user()->phone }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Información de la Compra -->
                    <div class="bg-border/20 rounded-lg p-5">
                        <h3 class="text-sm font-semibold text-textMuted uppercase tracking-wide mb-3">Detalles de Compra:</h3>
                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <span class="text-textMuted text-sm">Fecha:</span>
                                <span class="text-white text-sm font-medium">{{ $purchase->purchase_date->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-textMuted text-sm">Hora:</span>
                                <span class="text-white text-sm font-medium">{{ $purchase->purchase_date->format('h:i A') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-textMuted text-sm">Método de Pago:</span>
                                <span class="text-white text-sm font-medium">Tarjeta ****{{ $purchase->payment_details['card_number'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Items de la Factura -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-white mb-4">Items Comprados</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-border/20">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-textMuted uppercase tracking-wider">Cupón</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-textMuted uppercase tracking-wider">Código</th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold text-textMuted uppercase tracking-wider">Precio</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border">
                                @foreach($invoiceItems as $item)
                                    <tr>
                                        <td class="px-4 py-4">
                                            <div>
                                                <p class="text-white font-medium">{{ $item->coupon->title }}</p>
                                                <p class="text-textMuted text-sm">{{ Str::limit($item->coupon->description, 50) }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-mono font-bold bg-primary/20 text-primary border border-primary/30">
                                                {{ $item->unique_code }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-right">
                                            <p class="text-white font-semibold">${{ number_format($item->coupon->offer_price, 2) }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Totales -->
                <div class="bg-border/20 rounded-lg p-6">
                    <div class="space-y-3">
                        <div class="flex justify-between text-white">
                            <span class="text-textMuted">Subtotal:</span>
                            <span class="font-medium">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-white">
                            <span class="text-textMuted">Impuestos:</span>
                            <span class="font-medium">$0.00</span>
                        </div>
                        <div class="border-t border-border pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-white">Total:</span>
                                <span class="text-3xl font-bold text-primary">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nota -->
                <div class="mt-6 bg-primary/10 border border-primary/30 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-white text-sm font-medium mb-1">Información Importante</p>
                            <p class="text-textMuted text-sm">
                                Esta factura corresponde a la compra de {{ $invoiceItems->count() }} {{ $invoiceItems->count() == 1 ? 'cupón' : 'cupones' }}. 
                                Cada cupón tiene un código único que debe ser presentado en el establecimiento para su canje.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('client.invoices') }}" class="flex-1 bg-border hover:bg-border/80 text-textMuted hover:text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver a Facturas
            </a>
            <button onclick="window.print()" class="flex-1 bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Imprimir Factura
            </button>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .max-w-4xl, .max-w-4xl * {
                visibility: visible;
            }
            .max-w-4xl {
                position: absolute;
                left: 0;
                top: 0;
            }
            button, a {
                display: none !important;
            }
        }
    </style>
</x-client-layout>
