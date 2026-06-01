<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

/**
 * @class VerifyEmailController
 * @package App\Http\Controllers\Auth
 * @description Controlador para verificación de email del usuario.
 * Marca el email del usuario como verificado cuando accede al enlace.
 */
class VerifyEmailController extends Controller
{
    /**
     * Marca la dirección de email del usuario autenticado como verificada.
     * Comprueba si ya está verificado y emite evento de verificación.
     *
     * @param \Illuminate\Foundation\Auth\EmailVerificationRequest $request Solicitud de verificación firmada
     * @return \Illuminate\Http\RedirectResponse Redirecciona al dashboard
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
