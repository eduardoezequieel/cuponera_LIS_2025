<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::role('cliente')
            ->withCount('purchases')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'dui' => ['nullable', 'string', 'max:10', 'unique:users,dui'],
            'birth_date' => ['nullable', 'date', 'before:today'],
        ]);

        $client = User::create([
            'name' => $validated['name'],
            'lastname' => $validated['lastname'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'dui' => $validated['dui'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
        ]);

        $client->assignRole('cliente');

        return redirect()->route('admin.clients.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    public function edit(User $client)
    {
        // Verificar que el usuario sea un cliente
        if (!$client->hasRole('cliente')) {
            abort(404);
        }

        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, User $client)
    {
        // Verificar que el usuario sea un cliente
        if (!$client->hasRole('cliente')) {
            return redirect()->route('admin.clients.index')
                ->with('error', 'No se puede editar este usuario.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($client->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($client->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'dui' => ['nullable', 'string', 'max:10', Rule::unique('users')->ignore($client->id)],
            'birth_date' => ['nullable', 'date', 'before:today'],
        ]);

        $client->update([
            'name' => $validated['name'],
            'lastname' => $validated['lastname'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'dui' => $validated['dui'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
        ]);

        // Solo actualizar la contraseña si se proporcionó una nueva
        if (!empty($validated['password'])) {
            $client->update([
                'password' => Hash::make($validated['password'])
            ]);
        }

        return redirect()->route('admin.clients.show', $client)
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    public function show(User $client)
    {
        // Verificar que el usuario sea un cliente
        if (!$client->hasRole('cliente')) {
            abort(404);
        }

        // Cargar relaciones necesarias
        $client->load(['purchases.coupon.user']);

        // Estadísticas del cliente
        $totalPurchases = $client->purchases->count();
        $totalSpent = $client->purchases->sum(function ($purchase) {
            return $purchase->coupon->offer_price;
        });

        $lastPurchase = $client->purchases()
            ->orderBy('purchase_date', 'desc')
            ->first();

        // Cupones más comprados por el cliente
        $topCoupons = $client->purchases()
            ->with('coupon')
            ->get()
            ->groupBy('coupon_id')
            ->map(function ($purchases) {
                return [
                    'coupon' => $purchases->first()->coupon,
                    'count' => $purchases->count(),
                    'total_spent' => $purchases->sum(function ($p) {
                        return $p->coupon->offer_price;
                    })
                ];
            })
            ->sortByDesc('count')
            ->take(5);

        return view('admin.clients.show', compact(
            'client',
            'totalPurchases',
            'totalSpent',
            'lastPurchase',
            'topCoupons'
        ));
    }

    public function destroy(User $client)
    {
        // Verificar que el usuario sea un cliente
        if (!$client->hasRole('cliente')) {
            return redirect()->route('admin.clients.index')
                ->with('error', 'No se puede eliminar este usuario.');
        }

        $clientName = $client->fullname;
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', "Cliente {$clientName} eliminado exitosamente.");
    }
}
