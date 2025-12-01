<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Reportes') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Centro de Reportes</h1>
            <p class="text-textMuted">Analiza el rendimiento y estadísticas del sistema</p>
        </div>

        <!-- Reportes Disponibles -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Reporte de Ventas por Empresa -->
            <a href="{{ route('admin.reports.sales-by-company') }}" class="bg-secondary rounded-xl shadow-lg border border-border hover:border-primary transition-all p-6 group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary/30 transition-colors">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white mb-2">Ventas por Empresa</h3>
                        <p class="text-textMuted text-sm">Total de cupones vendidos por cada empresa</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-primary text-sm font-medium">
                    Ver reporte
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>

            <!-- Reporte de Ganancias por Empresa -->
            <a href="{{ route('admin.reports.profits-by-company') }}" class="bg-secondary rounded-xl shadow-lg border border-border hover:border-primary transition-all p-6 group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center group-hover:bg-green-500/30 transition-colors">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white mb-2">Ganancias por Empresa</h3>
                        <p class="text-textMuted text-sm">Ganancias de la plataforma por cada empresa</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-green-400 text-sm font-medium">
                    Ver reporte
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>

            <!-- Más reportes pueden agregarse aquí -->
            <div class="bg-secondary/50 rounded-xl shadow-lg border border-border/50 p-6 opacity-50">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-textMuted/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-textMuted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-textMuted mb-2">Más reportes próximamente</h3>
                        <p class="text-textMuted text-sm">Pronto estarán disponibles más reportes</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Información -->
        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 border border-primary/30 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-2">Sobre los Reportes</h3>
                    <p class="text-sm text-textMuted">
                        Los reportes te permiten analizar el rendimiento del sistema, las ventas por empresa, 
                        y obtener insights valiosos para la toma de decisiones. Puedes filtrar por fechas 
                        y exportar los datos cuando lo necesites.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
