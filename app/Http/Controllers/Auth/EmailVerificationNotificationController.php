<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * @class EmailVerificationNotificationController
 * @package App\Http\Controllers\Auth
 * @description Controlador para envío de notificaciones de verificación de email.
 * Reenvía el email de verificación si aún no está verificado.
 */
class EmailVerificationNotificationController extends Controller
{
    /**
     * Envía una nueva notificación de verificación de email.
     * Si ya está verificado, redirige al dashboard.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud HTTP
     * @return \Illuminate\Http\RedirectResponse Redirecciona hacia atrás o al dashboard
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
