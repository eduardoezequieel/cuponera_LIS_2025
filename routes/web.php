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
        return view('company.dashboard');
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
});

// Company routes
Route::middleware(['auth', 'role:empresa'])->prefix('company')->name('company.')->group(function () {
    Route::resource('coupons', \App\Http\Controllers\Company\CouponController::class);
});

// Client routes
Route::get('/coupons', [\App\Http\Controllers\Client\ClientController::class, 'index'])->name('client.coupons.index');
Route::get('/coupons/{coupon}', [\App\Http\Controllers\Client\ClientController::class, 'show'])->name('client.coupons.show');
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/coupons/{coupon}/purchase', [\App\Http\Controllers\Client\ClientController::class, 'purchase'])->name('client.coupons.purchase');
    Route::post('/coupons/{coupon}/purchase', [\App\Http\Controllers\Client\ClientController::class, 'store'])->name('client.coupons.store');
});

require __DIR__.'/auth.php';
