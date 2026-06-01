<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

/**
 * @class PasswordResetLinkController
 * @package App\Http\Controllers\Auth
 * @description Controlador para manejar solicitudes de recuperación de contraseña.
 * Muestra el formulario y envía enlaces de reset al email del usuario.
 */
class PasswordResetLinkController extends Controller
{
    /**
     * Muestra la vista del formulario de solicitud de enlace de recuperación.
     *
     * @return \Inertia\Response Vista del formulario
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Procesa una solicitud de enlace de recuperación de contraseña.
     * Envía un email con el enlace de reset al usuario.
     *
     * @param \Illuminate\Http\Request $request Email del usuario
     * @return \Illuminate\Http\RedirectResponse Redirecciona con estado del envío
     * @throws \Illuminate\Validation\ValidationException Si el email es inválido
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
