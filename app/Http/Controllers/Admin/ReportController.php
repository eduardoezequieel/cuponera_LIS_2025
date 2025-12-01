<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function salesByCompany(Request $request)
    {
        // Obtener fechas del request o usar valores por defecto
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now()->endOfMonth());

        // Reporte de ventas por empresa
        $salesByCompany = User::role('empresa')
            ->where('company_approved', true)
            ->withCount(['coupons as total_coupons'])
            ->with(['coupons' => function ($query) use ($startDate, $endDate) {
                $query->withCount(['purchases' => function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('purchase_date', [$startDate, $endDate]);
                }]);
            }])
            ->get()
            ->map(function ($company) use ($startDate, $endDate) {
                // Calcular ventas totales
                $totalSales = Purchase::whereHas('coupon', function ($query) use ($company) {
                    $query->where('user_id', $company->id);
                })
                ->whereBetween('purchase_date', [$startDate, $endDate])
                ->count();

                // Calcular ingresos totales
                $totalRevenue = Purchase::whereHas('coupon', function ($query) use ($company) {
                    $query->where('user_id', $company->id);
                })
                ->whereBetween('purchase_date', [$startDate, $endDate])
                ->get()
                ->sum(function ($purchase) {
                    return $purchase->coupon->offer_price;
                });

                return [
                    'company' => $company,
                    'total_coupons' => $company->total_coupons,
                    'total_sales' => $totalSales,
                    'total_revenue' => $totalRevenue,
                ];
            })
            ->sortByDesc('total_sales');

        // Calcular totales generales
        $totalSalesAll = $salesByCompany->sum('total_sales');
        $totalRevenueAll = $salesByCompany->sum('total_revenue');

        // Si se solicita PDF, generar y descargar
        if ($request->has('export') && $request->export === 'pdf') {
            $pdf = Pdf::loadView('admin.reports.sales-by-company-pdf', compact(
                'salesByCompany',
                'totalSalesAll',
                'totalRevenueAll',
                'startDate',
                'endDate'
            ));

            $pdf->setPaper('a4', 'landscape');

            $filename = 'reporte-ventas-empresas-' . now()->format('Y-m-d') . '.pdf';
            return $pdf->download($filename);
        }

        return view('admin.reports.sales-by-company', compact(
            'salesByCompany',
            'totalSalesAll',
            'totalRevenueAll',
            'startDate',
            'endDate'
        ));
    }

    public function profitsByCompany(Request $request)
    {
        // Obtener fechas del request o usar valores por defecto
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now()->endOfMonth());

        // Reporte de ganancias por empresa
        $profitsByCompany = User::role('empresa')
            ->where('company_approved', true)
            ->get()
            ->map(function ($company) use ($startDate, $endDate) {
                // Calcular ventas totales y monto vendido
                $purchases = Purchase::whereHas('coupon', function ($query) use ($company) {
                    $query->where('user_id', $company->id);
                })
                ->whereBetween('purchase_date', [$startDate, $endDate])
                ->with('coupon')
                ->get();

                $totalSales = $purchases->count();
                $totalRevenue = $purchases->sum(function ($purchase) {
                    return $purchase->coupon->offer_price;
                });

                // Calcular ganancia de la plataforma
                $platformProfit = $totalRevenue * ($company->commission_percentage / 100);
                $companyProfit = $totalRevenue - $platformProfit;

                return [
                    'company' => $company,
                    'total_sales' => $totalSales,
                    'total_revenue' => $totalRevenue,
                    'commission_percentage' => $company->commission_percentage,
                    'platform_profit' => $platformProfit,
                    'company_profit' => $companyProfit,
                ];
            })
            ->sortByDesc('platform_profit');

        // Calcular totales generales
        $totalSalesAll = $profitsByCompany->sum('total_sales');
        $totalRevenueAll = $profitsByCompany->sum('total_revenue');
        $totalPlatformProfit = $profitsByCompany->sum('platform_profit');
        $totalCompanyProfit = $profitsByCompany->sum('company_profit');

        // Si se solicita PDF, generar y descargar
        if ($request->has('export') && $request->export === 'pdf') {
            $pdf = Pdf::loadView('admin.reports.profits-by-company-pdf', compact(
                'profitsByCompany',
                'totalSalesAll',
                'totalRevenueAll',
                'totalPlatformProfit',
                'totalCompanyProfit',
                'startDate',
                'endDate'
            ));

            $pdf->setPaper('a4', 'landscape');

            $filename = 'reporte-ganancias-empresas-' . now()->format('Y-m-d') . '.pdf';
            return $pdf->download($filename);
        }

        return view('admin.reports.profits-by-company', compact(
            'profitsByCompany',
            'totalSalesAll',
            'totalRevenueAll',
            'totalPlatformProfit',
            'totalCompanyProfit',
            'startDate',
            'endDate'
        ));
    }
}
