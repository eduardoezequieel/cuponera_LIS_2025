<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.clients.index') }}" class="text-textMuted hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    Detalle del Cliente
                </h2>
            </div>
            <a href="{{ route('admin.clients.edit', $client) }}" 
               class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Editar Cliente
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500 text-green-500 px-6 py-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Información del Cliente -->
        <div class="bg-secondary rounded-xl shadow-lg border border-border overflow-hidden">
            <div class="relative h-32 bg-gradient-to-r from-primary via-purple-600 to-pink-600">
                <div class="absolute -bottom-12 left-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-primary to-purple-600 rounded-full flex items-center justify-center border-4 border-secondary shadow-xl">
                        <span class="text-white font-bold text-3xl">
                            {{ strtoupper(substr($client->name, 0, 1)) }}{{ strtoupper(substr($client->lastname ?? '', 0, 1)) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="pt-16 px-6 pb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-2">{{ $client->fullname }}</h3>
                        <p class="text-textMuted mb-4">@if($client->username){{ '@' . $client->username }}@endif</p>
                        
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 text-textMuted">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $client->email }}</span>
                            </div>

                            @if($client->dui)
                            <div class="flex items-center gap-3 text-textMuted">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                                <span>DUI: {{ $client->dui }}</span>
                            </div>
                            @endif

                            @if($client->birth_date)
                            <div class="flex items-center gap-3 text-textMuted">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Nacimiento: {{ \Carbon\Carbon::parse($client->birth_date)->format('d/m/Y') }}</span>
                            </div>
                            @endif

                            <div class="flex items-center gap-3 text-textMuted">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Registrado: {{ $client->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas rápidas -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-background rounded-lg p-4 border border-border">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-textMuted">Total Compras</p>
                                    <p class="text-xl font-bold text-white">{{ $totalPurchases }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-background rounded-lg p-4 border border-border">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-textMuted">Total Gastado</p>
                                    <p class="text-xl font-bold text-white">${{ number_format($totalSpent, 2) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-background rounded-lg p-4 border border-border col-span-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-textMuted">Última Compra</p>
                                    <p class="text-sm font-semibold text-white">
                                        @if($lastPurchase)
                                            {{ $lastPurchase->purchase_date->locale('es')->diffForHumans() }}
                                        @else
                                            Sin compras
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cupones Más Comprados -->
        @if($topCoupons->count() > 0)
        <div class="bg-secondary rounded-xl shadow-lg border border-border p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Cupones Más Comprados</h3>
            <div class="space-y-3">
                @foreach($topCoupons as $item)
                <div class="flex items-center justify-between p-4 bg-background rounded-lg border border-border hover:border-primary/50 transition-colors">
                    <div class="flex-1">
                        <p class="text-white font-medium">{{ $item['coupon']->title }}</p>
                        <p class="text-textMuted text-sm">{{ $item['coupon']->user->company_name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-white font-bold">{{ $item['count'] }} {{ $item['count'] == 1 ? 'compra' : 'compras' }}</p>
                        <p class="text-textMuted text-sm">${{ number_format($item['total_spent'], 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Historial de Compras -->
        <div class="bg-secondary rounded-xl shadow-lg border border-border overflow-hidden">
            <div class="p-6 border-b border-border">
                <h3 class="text-lg font-semibold text-white">Historial de Compras</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-background/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-textMuted uppercase tracking-wider">Cupón</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-textMuted uppercase tracking-wider">Empresa</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-textMuted uppercase tracking-wider">Código</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-textMuted uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-textMuted uppercase tracking-wider">Precio</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($client->purchases->sortByDesc('purchase_date') as $purchase)
                        <tr class="hover:bg-background/30 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-white font-medium">{{ $purchase->coupon->title }}</p>
                            </td>
                            <td class="px-6 py-4 text-textMuted">
                                {{ $purchase->coupon->user->company_name }}
                            </td>
                            <td class="px-6 py-4">
                                <code class="px-2 py-1 bg-primary/10 text-primary rounded text-sm font-mono">
                                    {{ $purchase->unique_code }}
                                </code>
                            </td>
                            <td class="px-6 py-4 text-textMuted">
                                {{ $purchase->purchase_date->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-green-500 font-semibold">
                                    ${{ number_format($purchase->coupon->offer_price, 2) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-12 h-12 text-textMuted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <p class="text-textMuted">Este cliente aún no ha realizado compras</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
