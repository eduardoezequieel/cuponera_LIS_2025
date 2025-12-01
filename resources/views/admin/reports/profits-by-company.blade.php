<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.reports.index') }}" class="text-textMuted hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    Reporte de Ganancias por Empresa
                </h2>
            </div>
            <a href="{{ route('admin.reports.profits-by-company', array_merge(request()->all(), ['export' => 'pdf'])) }}" 
               class="bg-primary hover:bg-primary/90 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Exportar a PDF
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Filtros -->
        <div class="bg-secondary rounded-xl shadow-lg border border-border p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Filtros</h3>
            <form method="GET" action="{{ route('admin.reports.profits-by-company') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-textMuted mb-2">Fecha Inicio</label>
                    <input type="date" 
                           id="start_date" 
                           name="start_date" 
                           value="{{ request('start_date', $startDate instanceof \Carbon\Carbon ? $startDate->format('Y-m-d') : now()->startOfMonth()->format('Y-m-d')) }}"
                           class="w-full px-4 py-2 bg-background border border-border rounded-lg text-white focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-textMuted mb-2">Fecha Fin</label>
                    <input type="date" 
                           id="end_date" 
                           name="end_date" 
                           value="{{ request('end_date', $endDate instanceof \Carbon\Carbon ? $endDate->format('Y-m-d') : now()->endOfMonth()->format('Y-m-d')) }}"
                           class="w-full px-4 py-2 bg-background border border-border rounded-lg text-white focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-6 rounded-lg transition-colors">
                        Aplicar Filtros
                    </button>
                </div>
            </form>
        </div>

        <!-- Resumen -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-secondary rounded-xl shadow-lg border border-border p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-textMuted text-sm">Empresas</p>
                        <p class="text-2xl font-bold text-white">{{ $profitsByCompany->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-secondary rounded-xl shadow-lg border border-border p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-textMuted text-sm">Total Ventas</p>
                        <p class="text-2xl font-bold text-white">{{ number_format($totalSalesAll) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-secondary rounded-xl shadow-lg border border-border p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-textMuted text-sm">Total Vendido</p>
                        <p class="text-2xl font-bold text-white">${{ number_format($totalRevenueAll, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500/20 to-green-600/20 rounded-xl shadow-lg border border-green-500/30 p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-500/30 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-textMuted text-sm">Ganancia Plataforma</p>
                        <p class="text-2xl font-bold text-green-400">${{ number_format($totalPlatformProfit, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información de Comisiones -->
        <div class="bg-gradient-to-r from-green-500/10 to-primary/10 border border-green-500/30 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-green-500/30 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-2">Sobre las Ganancias</h3>
                    <p class="text-sm text-textMuted">
                        Este reporte muestra las ganancias obtenidas por la plataforma basadas en el porcentaje de comisión 
                        asignado a cada empresa. La comisión se calcula sobre el total de ventas generadas por cada empresa 
                        en el período seleccionado.
                    </p>
                </div>
            </div>
        </div>

        <!-- Tabla de Datos -->
        <div class="bg-secondary rounded-xl shadow-lg border border-border overflow-hidden">
            <div class="p-6 border-b border-border">
                <h3 class="text-lg font-semibold text-white">Detalle por Empresa</h3>
            </div>
            @if($profitsByCompany->isEmpty())
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-textMuted mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-textMuted">No hay datos para mostrar en el período seleccionado</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-background">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-textMuted uppercase tracking-wider">#</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-textMuted uppercase tracking-wider">Empresa</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-textMuted uppercase tracking-wider">Ventas</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-textMuted uppercase tracking-wider">Total Vendido</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-textMuted uppercase tracking-wider">Comisión</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-textMuted uppercase tracking-wider">Ganancia Plataforma</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-textMuted uppercase tracking-wider">Ganancia Empresa</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @foreach($profitsByCompany as $index => $data)
                                <tr class="hover:bg-background/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            @if($index < 3)
                                                <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold
                                                    {{ $index === 0 ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                                                    {{ $index === 1 ? 'bg-gray-400/20 text-gray-300' : '' }}
                                                    {{ $index === 2 ? 'bg-orange-500/20 text-orange-400' : '' }}">
                                                    {{ $index + 1 }}
                                                </span>
                                            @else
                                                <span class="text-textMuted font-medium">{{ $index + 1 }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                                                <span class="text-white font-bold text-sm">{{ substr($data['company']->company_name, 0, 2) }}</span>
                                            </div>
                                            <div>
                                                <p class="text-white font-medium">{{ $data['company']->company_name }}</p>
                                                <p class="text-textMuted text-sm">{{ $data['company']->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-500/20 text-blue-400">
                                            {{ number_format($data['total_sales']) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-white font-semibold text-lg">${{ number_format($data['total_revenue'], 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/20 text-primary">
                                            {{ number_format($data['commission_percentage'], 2) }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-green-400 font-bold text-lg">${{ number_format($data['platform_profit'], 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-textMuted font-semibold">${{ number_format($data['company_profit'], 2) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-background/50 border-t-2 border-primary">
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-right font-bold text-white">TOTALES</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-white font-bold text-lg">{{ number_format($totalSalesAll) }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-white font-bold text-lg">${{ number_format($totalRevenueAll, 2) }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-textMuted font-medium">—</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-green-400 font-bold text-xl">${{ number_format($totalPlatformProfit, 2) }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-textMuted font-bold text-lg">${{ number_format($totalCompanyProfit, 2) }}</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
