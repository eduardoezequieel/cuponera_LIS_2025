<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida.',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Mensajes personalizados
        $messages = [
            Password::RESET_LINK_SENT => 'Te hemos enviado un enlace de recuperación de contraseña a tu correo electrónico.',
            Password::INVALID_USER => 'No encontramos ningún usuario con ese correo electrónico.',
            Password::RESET_THROTTLED => 'Por favor espera antes de volver a intentarlo. Ya enviamos un enlace recientemente.',
        ];

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', $messages[$status])
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => $messages[$status] ?? 'Ocurrió un error al intentar enviar el enlace.']);
    }
}
