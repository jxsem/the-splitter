<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

/**
 * @class AuthenticatedSessionController
 * @package App\Http\Controllers\Auth
 * @description Controlador para manejar la autenticación de usuarios (login/logout).
 * Muestra el formulario de inicio de sesión y procesa la autenticación.
 */
class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra la vista del formulario de inicio de sesión.
     * Incluye opciones para recuperación de contraseña si está habilitada.
     *
     * @return \Inertia\Response Vista del formulario de login
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Procesa una solicitud de autenticación.
     * Valida las credenciales del usuario y crea una sesión.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request Form Request con credenciales
     * @return \Illuminate\Http\RedirectResponse Redirecciona al dashboard o URL intendida
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destruye la sesión autenticada del usuario (logout).
     * Invalida la sesión y regenera el token CSRF.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud HTTP
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la página principal
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
