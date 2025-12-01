@php
    use App\Models\Coupon;
    use App\Models\User;
    use App\Models\Purchase;
    
    $totalCoupons = Coupon::count();
    $activeCoupons = Coupon::where('status', 'available')->count();
    $totalPurchases = Purchase::whereMonth('purchase_date', now()->month)->count();
    $lastMonthPurchases = Purchase::whereMonth('purchase_date', now()->subMonth()->month)->count();
    $purchaseGrowth = $lastMonthPurchases > 0 ? round((($totalPurchases - $lastMonthPurchases) / $lastMonthPurchases) * 100) : 0;
    
    $totalCompanies = User::role('empresa')->count();
    $pendingCompanies = User::role('empresa')->where('company_approved', false)->count();
    $approvedCompanies = User::role('empresa')->where('company_approved', true)->count();
    
    $expiringCoupons = Coupon::where('status', 'available')
        ->where('end_date', '<=', now()->addDays(7))
        ->count();
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Panel de Control - Admin') }}
            </h2>
            <span class="text-sm text-textMuted">
                {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-primary to-primary/80 rounded-xl shadow-lg p-6 border border-primary/50">
                <div class="flex items-center gap-4">
                    <div class="bg-white/10 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">¡Bienvenido, {{ Auth::user()->name }}!</h3>
                        <p class="text-white/80">Aquí tienes un resumen de la actividad en La Cuponera SV</p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Cupones -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-primary/50 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Total Cupones</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $totalCoupons }}</p>
                            <p class="text-textMuted text-xs mt-2">En el sistema</p>
                        </div>
                        <div class="bg-primary/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Cupones Activos -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-primary/50 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Cupones Activos</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $activeCoupons }}</p>
                            @if($expiringCoupons > 0)
                                <p class="text-orange-400 text-xs mt-2">{{ $expiringCoupons }} por vencer pronto</p>
                            @else
                                <p class="text-green-400 text-xs mt-2">Todos vigentes</p>
                            @endif
                        </div>
                        <div class="bg-green-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Compras del Mes -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-primary/50 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Compras del Mes</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $totalPurchases }}</p>
                            @if($purchaseGrowth > 0)
                                <p class="text-green-400 text-xs mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    +{{ $purchaseGrowth }}% vs mes anterior
                                </p>
                            @elseif($purchaseGrowth < 0)
                                <p class="text-red-400 text-xs mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                    </svg>
                                    {{ $purchaseGrowth }}% vs mes anterior
                                </p>
                            @else
                                <p class="text-textMuted text-xs mt-2">Sin cambios</p>
                            @endif
                        </div>
                        <div class="bg-yellow-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Empresas Registradas -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6 hover:border-primary/50 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-textMuted text-sm font-medium">Empresas</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $approvedCompanies }}</p>
                            @if($pendingCompanies > 0)
                                <p class="text-orange-400 text-xs mt-2">{{ $pendingCompanies }} pendientes de aprobación</p>
                            @else
                                <p class="text-green-400 text-xs mt-2">Todas aprobadas</p>
                            @endif
                        </div>
                        <div class="bg-purple-500/20 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $popularCoupons = Coupon::withCount('purchases')
                    ->where('status', 'available')
                    ->orderBy('purchases_count', 'desc')
                    ->take(5)
                    ->get();
                
                $recentPurchases = Purchase::with(['coupon', 'user'])
                    ->orderBy('purchase_date', 'desc')
                    ->take(6)
                    ->get();
                
                $expiringCouponsList = Coupon::where('status', 'available')
                    ->where('end_date', '<=', now()->addDays(7))
                    ->where('end_date', '>=', now())
                    ->orderBy('end_date', 'asc')
                    ->take(3)
                    ->get();
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Cupones Más Comprados -->
                <div class="lg:col-span-2 bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">🔥 Cupones Más Comprados</h3>
                    </div>
                    @if($popularCoupons->isEmpty())
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-textMuted mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-textMuted">No hay cupones disponibles aún</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($popularCoupons as $coupon)
                                <div class="flex items-center gap-4 p-4 bg-background rounded-lg border border-border hover:border-primary/50 transition-all">
                                    <div class="bg-gradient-to-br from-primary to-primary/60 p-3 rounded-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-white font-medium truncate">{{ $coupon->title }}</h4>
                                        <p class="text-textMuted text-sm truncate">{{ $coupon->user->company_name ?? $coupon->user->fullname }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-primary font-bold text-lg">${{ number_format($coupon->offer_price, 0) }}</p>
                                        <p class="text-textMuted text-xs">{{ $coupon->purchases_count }} {{ $coupon->purchases_count == 1 ? 'compra' : 'compras' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Actividad Reciente -->
                <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">📊 Actividad Reciente</h3>
                    </div>
                    @if($recentPurchases->isEmpty())
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-textMuted mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p class="text-textMuted text-sm">No hay actividad reciente</p>
                        </div>
                    @else
                        <div class="space-y-4 max-h-96 overflow-y-auto">
                            @foreach($recentPurchases as $purchase)
                                <div class="flex items-start gap-3">
                                    <div class="bg-green-500/20 p-2 rounded-full mt-1 flex-shrink-0">
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white text-sm truncate">Compra realizada</p>
                                        <p class="text-textMuted text-xs truncate">{{ $purchase->coupon->title }}</p>
                                        <p class="text-textMuted text-xs">{{ $purchase->purchase_date->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Cupones por Vencer -->
            @if($expiringCouponsList->isNotEmpty())
            <div class="bg-orange-500/10 border border-orange-500/30 rounded-xl p-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-white mb-3">⚠️ Cupones próximos a vencer</h3>
                        <div class="space-y-2">
                            @foreach($expiringCouponsList as $expiring)
                                <div class="flex items-center justify-between bg-background/50 rounded-lg p-3">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white text-sm font-medium truncate">{{ $expiring->title }}</p>
                                        <p class="text-textMuted text-xs">{{ $expiring->user->company_name ?? $expiring->user->fullname }}</p>
                                    </div>
                                    <div class="text-right ml-4">
                                        <p class="text-orange-400 text-sm font-semibold">{{ $expiring->end_date->diffForHumans() }}</p>
                                        <p class="text-textMuted text-xs">{{ $expiring->end_date->locale('es')->isoFormat('D MMM') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>