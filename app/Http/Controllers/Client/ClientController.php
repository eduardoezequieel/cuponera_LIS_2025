<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function index()
    {
        $coupons = Coupon::where('status', 'available')->get();
        return view('client.coupons.index', compact('coupons'));
    }

    public function show(Coupon $coupon)
    {
        return view('client.coupons.show', compact('coupon'));
    }

    public function purchase(Coupon $coupon)
    {
        // Verificar si el usuario está autenticado y es cliente
        if (!Auth::check() || !Auth::user()->hasRole('cliente')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión como cliente para comprar.');
        }

        // Verificar edad > 18
        $user = Auth::user();
        $age = Carbon::parse($user->birth_date)->age;
        if ($age <= 18) {
            return back()->with('error', 'Debes tener más de 18 años para comprar cupones.');
        }

        // Verificar límite de 5 cupones por oferta
        $purchases = Purchase::where('user_id', $user->id)->where('coupon_id', $coupon->id)->count();
        if ($purchases >= 5) {
            return back()->with('error', 'Ya has alcanzado el límite de 5 cupones para esta oferta.');
        }

        return view('client.coupons.purchase', compact('coupon'));
    }

    public function store(Request $request, Coupon $coupon)
    {
        // Validaciones
        $request->validate([
            'card_number' => 'required|string|regex:/^\d{4} ?\d{4} ?\d{4} ?\d{4}$/',
            'expiry_month' => 'required|integer|min:1|max:12',
            'expiry_year' => 'required|integer|min:' . date('Y'),
            'cvv' => 'required|string|regex:/^\d{3,4}$/',
            'card_holder' => 'required|string|max:255',
        ]);

        // Limpiar número de tarjeta
        $cleanCardNumber = preg_replace('/\s+/', '', $request->card_number);

        // Verificar fecha de expiración
        $expiry = Carbon::createFromDate($request->expiry_year, $request->expiry_month, 1)->endOfMonth();
        if ($expiry->isPast()) {
            return back()->withErrors(['expiry_month' => 'La fecha de expiración de la tarjeta es inválida.']);
        }

        $user = Auth::user();

        // Generar código único
        $uniqueCode = Str::upper(Str::random(10));

        // Crear compra
        Purchase::create([
            'user_id' => $user->id,
            'coupon_id' => $coupon->id,
            'purchase_date' => now(),
            'unique_code' => $uniqueCode,
            'payment_details' => [
                'card_number' => substr($cleanCardNumber, -4), // Solo últimos 4 dígitos
                'expiry_month' => $request->expiry_month,
                'expiry_year' => $request->expiry_year,
                'card_holder' => $request->card_holder,
            ],
        ]);

        return redirect()->route('client.coupons.index')->with('success', 'Compra realizada exitosamente. Código único: ' . $uniqueCode);
    }
}
