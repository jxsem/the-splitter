<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * @class EmailVerificationPromptController
 * @package App\Http\Controllers\Auth
 * @description Controlador que muestra el prompt de verificación de email.
 * Redirige al dashboard si ya está verificado.
 */
class EmailVerificationPromptController extends Controller
{
    /**
     * Muestra el prompt de verificación de email o redirige si ya está verificado.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud HTTP
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response Vista o redirección
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }
}
