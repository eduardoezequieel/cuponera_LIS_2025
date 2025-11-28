<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = User::role('empresa')->paginate(10);
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Normalize inputs (remove mask characters)
        $request->merge([
            'nit' => str_replace('-', '', $request->nit),
            'phone' => str_replace('-', '', $request->phone)
        ]);

        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'nit' => ['required', 'string', 'size:14', 'unique:users,nit'],
            'phone' => ['required', 'string', 'max:8'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'address' => ['required', 'string', 'max:255'],
            'company_approved' => ['sometimes', 'boolean'],
            'password' => ['required', 'confirmed'],
        ], [
            'company_name.required' => 'El nombre de la compañia es obligatorio.',
            'nit.required' => 'El NIT es obligatorio.',
            'nit.unique' => 'El NIT ya existe.',
            'nit.size' => 'El NIT debe tener 14 caracteres.',
            'phone.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El correo electrónico ya existe.',
            'address.required' => 'La dirección es obligatoria.',
            'company_approved.boolean' => 'El valor de aprobación es inválido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::create([
            'name' => $request->company_name,
            'company_name' => $request->company_name,
            'nit' => $request->nit,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'company_approved' => $request->has('company_approved'),
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('empresa');

        return redirect()->route('admin.companies.index')
            ->with('success', 'Empresa creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $company)
    {
        return redirect()->route('admin.companies.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $company)
    {
        $request->merge([
            'nit' => str_replace('-', '', $request->nit),
            'phone' => str_replace('-', '', $request->phone)
        ]);

        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'nit' => ['required', 'string', 'size:14', 'unique:users,nit,' . $company->id],
            'phone' => ['required', 'string', 'max:8'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $company->id],
            'address' => ['required', 'string', 'max:255'],
            'company_approved' => ['sometimes', 'boolean'],
            'password' => ['nullable', 'confirmed'],
        ], [
            'company_name.required' => 'El nombre de la compañia es obligatorio.',
            'nit.required' => 'El NIT es obligatorio.',
            'nit.unique' => 'El NIT ya existe.',
            'nit.size' => 'El NIT debe tener 14 caracteres.',
            'phone.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El correo electrónico ya existe.',
            'address.required' => 'La dirección es obligatoria.',
            'company_approved.boolean' => 'El valor de aprobación es inválido.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $company->update([
            'company_name' => $request->company_name,
            'nit' => $request->nit,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'company_approved' => $request->has('company_approved'),
        ]);

        if ($request->filled('password')) {
            $company->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.companies.index')
            ->with('success', 'Empresa actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $company)
    {
        $company->delete();

        return redirect()->route('admin.companies.index')
            ->with('success', 'Empresa eliminada exitosamente.');
    }
}
