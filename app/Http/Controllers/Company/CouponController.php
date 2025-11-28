<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::where('user_id', Auth::id())->paginate(10);
        return view('company.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'regular_price' => 'required|numeric|min:0',
            'offer_price' => 'required|numeric|min:0|lt:regular_price',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'redemption_deadline' => 'required|date|after:end_date',
            'quantity' => 'nullable|integer|min:1',
            'description' => 'required|string',
            'status' => 'required|in:available,unavailable',
        ], [
            'title.required' => 'El título del cupón es obligatorio.',
            'title.string' => 'El título debe ser un texto válido.',
            'title.max' => 'El título no puede tener más de 255 caracteres.',

            'regular_price.required' => 'El precio regular es obligatorio.',
            'regular_price.numeric' => 'El precio regular debe ser un número válido.',
            'regular_price.min' => 'El precio regular debe ser mayor o igual a 0.',

            'offer_price.required' => 'El precio de oferta es obligatorio.',
            'offer_price.numeric' => 'El precio de oferta debe ser un número válido.',
            'offer_price.min' => 'El precio de oferta debe ser mayor o igual a 0.',
            'offer_price.lt' => 'El precio de oferta debe ser menor al precio regular.',

            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            // Mensaje personalizado para validación manual
            'start_date.after_or_equal' => 'La fecha de inicio debe ser hoy o una fecha futura.',

            'end_date.required' => 'La fecha de fin es obligatoria.',
            'end_date.date' => 'La fecha de fin debe ser una fecha válida.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',

            'redemption_deadline.required' => 'La fecha límite de canje es obligatoria.',
            'redemption_deadline.date' => 'La fecha límite de canje debe ser una fecha válida.',
            'redemption_deadline.after' => 'La fecha límite de canje debe ser posterior a la fecha de fin.',

            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad mínima es 1.',

            'description.required' => 'La descripción del cupón es obligatoria.',
            'description.string' => 'La descripción debe ser un texto válido.',

            'status.required' => 'El estado del cupón es obligatorio.',
            'status.in' => 'El estado debe ser disponible o no disponible.',
        ]);

        // Validación manual para permitir hoy como fecha de inicio usando la zona horaria de El Salvador
        $startDate = $request->input('start_date');
        if ($startDate) {
            $startDateCarbon = \Carbon\Carbon::createFromFormat('Y-m-d', $startDate, 'America/El_Salvador')->startOfDay();
            $todayCarbon = \Carbon\Carbon::now('America/El_Salvador')->startOfDay();

            if ($startDateCarbon->lt($todayCarbon)) {
                return back()->withInput()->withErrors(['start_date' => 'La fecha de inicio debe ser hoy o una fecha futura.']);
            }
        }

        Coupon::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'regular_price' => $request->regular_price,
            'offer_price' => $request->offer_price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'redemption_deadline' => $request->redemption_deadline,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('company.coupons.index')->with('success', 'Cupón creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coupon = Coupon::where('user_id', Auth::id())->findOrFail($id);
        return view('company.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::where('user_id', Auth::id())->findOrFail($id);
        return view('company.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coupon = Coupon::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'regular_price' => 'required|numeric|min:0',
            'offer_price' => 'required|numeric|min:0|lt:regular_price',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'redemption_deadline' => 'required|date|after:end_date',
            'quantity' => 'nullable|integer|min:1',
            'description' => 'required|string',
            'status' => 'required|in:available,unavailable',
        ], [
            'title.required' => 'El título del cupón es obligatorio.',
            'title.string' => 'El título debe ser un texto válido.',
            'title.max' => 'El título no puede tener más de 255 caracteres.',

            'regular_price.required' => 'El precio regular es obligatorio.',
            'regular_price.numeric' => 'El precio regular debe ser un número válido.',
            'regular_price.min' => 'El precio regular debe ser mayor o igual a 0.',

            'offer_price.required' => 'El precio de oferta es obligatorio.',
            'offer_price.numeric' => 'El precio de oferta debe ser un número válido.',
            'offer_price.min' => 'El precio de oferta debe ser mayor o igual a 0.',
            'offer_price.lt' => 'El precio de oferta debe ser menor al precio regular.',

            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            // Mensaje personalizado para validación manual
            'start_date.after_or_equal' => 'La fecha de inicio debe ser hoy o una fecha futura.',

            'end_date.required' => 'La fecha de fin es obligatoria.',
            'end_date.date' => 'La fecha de fin debe ser una fecha válida.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',

            'redemption_deadline.required' => 'La fecha límite de canje es obligatoria.',
            'redemption_deadline.date' => 'La fecha límite de canje debe ser una fecha válida.',
            'redemption_deadline.after' => 'La fecha límite de canje debe ser posterior a la fecha de fin.',

            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad mínima es 1.',

            'description.required' => 'La descripción del cupón es obligatoria.',
            'description.string' => 'La descripción debe ser un texto válido.',

            'status.required' => 'El estado del cupón es obligatorio.',
            'status.in' => 'El estado debe ser disponible o no disponible.',
        ]);

        // Validación manual para permitir hoy como fecha de inicio usando la zona horaria de El Salvador
        $startDate = $request->input('start_date');
        if ($startDate) {
            $startDateCarbon = \Carbon\Carbon::createFromFormat('Y-m-d', $startDate, 'America/El_Salvador')->startOfDay();
            $todayCarbon = \Carbon\Carbon::now('America/El_Salvador')->startOfDay();

            if ($startDateCarbon->lt($todayCarbon)) {
                return back()->withInput()->withErrors(['start_date' => 'La fecha de inicio debe ser hoy o una fecha futura.']);
            }
        }
        $coupon->update($request->only([
            'title', 'regular_price', 'offer_price', 'start_date', 'end_date', 'redemption_deadline', 'quantity', 'description', 'status'
        ]));

        return redirect()->route('company.coupons.index')->with('success', 'Cupón actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::where('user_id', Auth::id())->findOrFail($id);
        $coupon->delete();

        return redirect()->route('company.coupons.index')->with('success', 'Cupón eliminado exitosamente.');
    }
}
