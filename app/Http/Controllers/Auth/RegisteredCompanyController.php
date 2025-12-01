<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredCompanyController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register-company');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
            'commission_percentage' => 10.00,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('empresa'); // Asignar rol por defecto

        event(new Registered($user));
        return redirect()->route('register-pending');
    }
}
