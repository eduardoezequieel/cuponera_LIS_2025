<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function dashboard()
    {
        $company = Auth::user();

        // Total de cupones creados por la empresa
        $totalCoupons = Coupon::where('user_id', $company->id)->count();

        // Cupones activos (status = available y dentro de fechas)
        $activeCoupons = Coupon::where('user_id', $company->id)
            ->where('status', 'available')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->count();

        // Total de ventas (compras de mis cupones)
        $totalSales = Purchase::whereHas('coupon', function ($query) use ($company) {
            $query->where('user_id', $company->id);
        })->count();

        // Ventas del mes actual
        $salesThisMonth = Purchase::whereHas('coupon', function ($query) use ($company) {
            $query->where('user_id', $company->id);
        })
        ->whereMonth('purchase_date', now()->month)
        ->whereYear('purchase_date', now()->year)
        ->count();

        // Ventas del mes anterior
        $salesLastMonth = Purchase::whereHas('coupon', function ($query) use ($company) {
            $query->where('user_id', $company->id);
        })
        ->whereMonth('purchase_date', now()->subMonth()->month)
        ->whereYear('purchase_date', now()->subMonth()->year)
        ->count();

        // Calcular ingresos totales
        $totalRevenue = Purchase::whereHas('coupon', function ($query) use ($company) {
            $query->where('user_id', $company->id);
        })
        ->with('coupon')
        ->get()
        ->sum(function ($purchase) {
            return $purchase->coupon->offer_price;
        });

        // Ingresos del mes actual
        $revenueThisMonth = Purchase::whereHas('coupon', function ($query) use ($company) {
            $query->where('user_id', $company->id);
        })
        ->whereMonth('purchase_date', now()->month)
        ->whereYear('purchase_date', now()->year)
        ->with('coupon')
        ->get()
        ->sum(function ($purchase) {
            return $purchase->coupon->offer_price;
        });

        // Cupones más vendidos (top 5)
        $topCoupons = Coupon::where('user_id', $company->id)
            ->withCount('purchases')
            ->orderBy('purchases_count', 'desc')
            ->take(5)
            ->get();

        // Cupones próximos a vencer (en los próximos 7 días)
        $expiringCoupons = Coupon::where('user_id', $company->id)
            ->where('status', 'available')
            ->whereBetween('end_date', [now(), now()->addDays(7)])
            ->count();

        // Actividad reciente (últimas 10 compras)
        $recentActivity = Purchase::whereHas('coupon', function ($query) use ($company) {
            $query->where('user_id', $company->id);
        })
        ->with('coupon', 'user')
        ->orderBy('purchase_date', 'desc')
        ->take(10)
        ->get();

        return view('company.dashboard', compact(
            'totalCoupons',
            'activeCoupons',
            'totalSales',
            'salesThisMonth',
            'salesLastMonth',
            'totalRevenue',
            'revenueThisMonth',
            'topCoupons',
            'expiringCoupons',
            'recentActivity'
        ));
    }
}
