<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/choose-role', function () {
    return view('choose-role');
})->name('choose-role');

Route::get('/dashboard', function () {
    if (Auth::user()->hasRole('admin')) {
        return view('admin.dashboard');
    } elseif (Auth::user()->hasRole('empresa')) {
        return redirect()->route('company.dashboard');
    } elseif (Auth::user()->hasRole('cliente')) {
        return redirect()->route('client.coupons.index');
    } else {
        abort(403);
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('dashboard')->name('admin.')->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class)->except(['index', 'show', 'destroy']);
    Route::get('clients', [\App\Http\Controllers\Admin\ClientController::class, 'index'])->name('clients.index');
    Route::get('clients/{client}', [\App\Http\Controllers\Admin\ClientController::class, 'show'])->name('clients.show');
    Route::delete('clients/{client}', [\App\Http\Controllers\Admin\ClientController::class, 'destroy'])->name('clients.destroy');
    Route::get('reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/sales-by-company', [\App\Http\Controllers\Admin\ReportController::class, 'salesByCompany'])->name('reports.sales-by-company');
    Route::get('reports/profits-by-company', [\App\Http\Controllers\Admin\ReportController::class, 'profitsByCompany'])->name('reports.profits-by-company');
});

// Company routes
Route::middleware(['auth', 'role:empresa'])->prefix('company')->name('company.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Company\CompanyController::class, 'dashboard'])->name('dashboard');
    Route::resource('coupons', \App\Http\Controllers\Company\CouponController::class);
});

// Client routes
Route::get('/coupons', [\App\Http\Controllers\Client\ClientController::class, 'index'])->name('client.coupons.index');
Route::get('/coupons/{coupon}', [\App\Http\Controllers\Client\ClientController::class, 'show'])->name('client.coupons.show');
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/coupons/{coupon}/purchase', [\App\Http\Controllers\Client\ClientController::class, 'purchase'])->name('client.coupons.purchase');
    Route::post('/coupons/{coupon}/purchase', [\App\Http\Controllers\Client\ClientController::class, 'store'])->name('client.coupons.store');
    Route::get('/my-coupons', [\App\Http\Controllers\Client\ClientController::class, 'myCoupons'])->name('client.my-coupons');
    Route::get('/my-coupons/{purchase}', [\App\Http\Controllers\Client\ClientController::class, 'showMyCoupon'])->name('client.my-coupon.show');
    Route::get('/invoices', [\App\Http\Controllers\Client\ClientController::class, 'invoices'])->name('client.invoices');
    Route::get('/invoices/{purchase}', [\App\Http\Controllers\Client\ClientController::class, 'showInvoice'])->name('client.invoice.show');
});

require __DIR__.'/auth.php';
