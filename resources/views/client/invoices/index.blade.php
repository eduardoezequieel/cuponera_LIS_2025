<x-client-layout>
    <div class="max-w-7xl mx-auto space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-white mb-1">Mis Facturas</h1>
            <p class="text-textMuted text-base">Historial completo de tus compras</p>
        </div>

        @if($invoices->isEmpty())
            <div class="bg-background rounded-xl shadow-lg border border-border p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-textMuted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-xl font-semibold text-white mb-2">No tienes facturas aún</h3>
                <p class="text-textMuted mb-6">Comienza a comprar cupones para ver tus facturas aquí</p>
                <a href="{{ route('client.coupons.index') }}" class="inline-flex items-center px-6 py-3 bg-primary hover:bg-primary/90 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Ver Cupones Disponibles
                </a>
            </div>
        @else
            <!-- Resumen -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-background rounded-xl shadow-lg border border-border p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-textMuted text-sm">Total Facturas</p>
                            <p class="text-2xl font-bold text-white">{{ $invoices->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-background rounded-xl shadow-lg border border-border p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-textMuted text-sm">Total Cupones</p>
                            <p class="text-2xl font-bold text-white">{{ $invoices->sum('quantity') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-background rounded-xl shadow-lg border border-border p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-textMuted text-sm">Total Gastado</p>
                            <p class="text-2xl font-bold text-white">${{ number_format($invoices->sum('total'), 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Facturas -->
            <div class="bg-background rounded-xl shadow-lg border border-border overflow-hidden">
                <div class="p-6 border-b border-border">
                    <h2 class="text-xl font-bold text-white">Historial de Facturas</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-border/20">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-textMuted uppercase tracking-wider">Factura</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-textMuted uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-textMuted uppercase tracking-wider">Items</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-textMuted uppercase tracking-wider">Total</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-textMuted uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @foreach($invoices as $invoice)
                                <tr class="hover:bg-border/10 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-white">#{{ str_pad($invoice['id'], 6, '0', STR_PAD_LEFT) }}</p>
                                                <p class="text-xs text-textMuted">Factura</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-white">{{ $invoice['date']->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</div>
                                        <div class="text-xs text-textMuted">{{ $invoice['date']->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/20 text-primary">
                                            {{ $invoice['quantity'] }} {{ $invoice['quantity'] == 1 ? 'cupón' : 'cupones' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-lg font-bold text-white">${{ number_format($invoice['total'], 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <a href="{{ route('client.invoice.show', $invoice['id']) }}" class="inline-flex items-center px-4 py-2 bg-primary hover:bg-primary/90 text-white text-sm font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Ver Detalle
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-client-layout>
