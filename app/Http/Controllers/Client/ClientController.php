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
        $coupons = Coupon::where('status', 'available')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
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

        // Verificar que hay cupones disponibles
        if ($coupon->quantity < 1) {
            return back()->with('error', 'No hay cupones disponibles para esta oferta.');
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
            'quantity' => 'required|integer|min:1|max:5',
        ]);

        // Limpiar número de tarjeta
        $cleanCardNumber = preg_replace('/\s+/', '', $request->card_number);

        // Verificar fecha de expiración
        $expiry = Carbon::createFromDate($request->expiry_year, $request->expiry_month, 1)->endOfMonth();
        if ($expiry->isPast()) {
            return back()->withErrors(['expiry_month' => 'La fecha de expiración de la tarjeta es inválida.']);
        }

        $user = Auth::user();
        $quantity = $request->quantity;

        // Verificar que hay suficientes cupones disponibles
        if ($coupon->quantity < $quantity) {
            return back()->withErrors(['quantity' => 'No hay suficientes cupones disponibles.']);
        }

        // Verificar límite de 5 cupones por usuario para esta oferta
        $existingPurchases = Purchase::where('user_id', $user->id)
            ->where('coupon_id', $coupon->id)
            ->count();

        if ($existingPurchases + $quantity > 5) {
            $remaining = 5 - $existingPurchases;
            return back()->withErrors(['quantity' => "Solo puedes comprar {$remaining} cupón(es) más de esta oferta."]);
        }

        $uniqueCodes = [];

        // Crear múltiples compras (una por cada cupón)
        for ($i = 0; $i < $quantity; $i++) {
            $uniqueCode = Str::upper(Str::random(10));
            $uniqueCodes[] = $uniqueCode;

            Purchase::create([
                'user_id' => $user->id,
                'coupon_id' => $coupon->id,
                'purchase_date' => now(),
                'unique_code' => $uniqueCode,
                'payment_details' => [
                    'card_number' => substr($cleanCardNumber, -4),
                    'expiry_month' => $request->expiry_month,
                    'expiry_year' => $request->expiry_year,
                    'card_holder' => $request->card_holder,
                ],
            ]);
        }

        // Restar la cantidad del inventario del cupón
        $coupon->decrement('quantity', $quantity);

        $message = $quantity == 1
            ? 'Compra realizada exitosamente. Código único: ' . $uniqueCodes[0]
            : 'Compra realizada exitosamente. Se generaron ' . $quantity . ' cupones con códigos únicos.';

        return redirect()->route('client.coupons.index')->with('success', $message);
    }

    public function myCoupons()
    {
        $user = Auth::user();
        $purchases = Purchase::with('coupon')
            ->where('user_id', $user->id)
            ->orderBy('purchase_date', 'desc')
            ->paginate(12);

        return view('client.coupons.my-coupons', compact('purchases'));
    }

    public function showMyCoupon(Purchase $purchase)
    {
        // Verificar que el cupón pertenece al usuario autenticado
        if ($purchase->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este cupón.');
        }

        return view('client.coupons.my-coupon-detail', compact('purchase'));
    }

    public function invoices()
    {
        $user = Auth::user();

        // Agrupar compras por fecha para crear facturas
        $purchases = Purchase::with('coupon')
            ->where('user_id', $user->id)
            ->orderBy('purchase_date', 'desc')
            ->get()
            ->groupBy(function ($purchase) {
                return $purchase->purchase_date->format('Y-m-d H:i:s');
            });

        // Calcular totales por grupo
        $invoices = $purchases->map(function ($group) {
            $firstPurchase = $group->first();
            return [
                'id' => $firstPurchase->id,
                'date' => $firstPurchase->purchase_date,
                'items' => $group,
                'total' => $group->sum(function ($purchase) {
                    return $purchase->coupon->offer_price;
                }),
                'quantity' => $group->count()
            ];
        })->values();

        return view('client.invoices.index', compact('invoices'));
    }

    public function showInvoice(Purchase $purchase)
    {
        // Verificar que la factura pertenece al usuario autenticado
        if ($purchase->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta factura.');
        }

        // Obtener todas las compras de la misma transacción (mismo momento)
        $invoiceItems = Purchase::with('coupon')
            ->where('user_id', Auth::id())
            ->where('purchase_date', $purchase->purchase_date)
            ->get();

        $total = $invoiceItems->sum(function ($item) {
            return $item->coupon->offer_price;
        });

        return view('client.invoices.show', compact('purchase', 'invoiceItems', 'total'));
    }
}
