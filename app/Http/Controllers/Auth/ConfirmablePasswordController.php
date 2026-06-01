<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

/**
 * @class ConfirmablePasswordController
 * @package App\Http\Controllers\Auth
 * @description Controlador para confirmación de contraseña.
 * Requiere confirmación de contraseña antes de operaciones sensibles.
 */
class ConfirmablePasswordController extends Controller
{
    /**
     * Muestra la vista de confirmación de contraseña.
     *
     * @return \Inertia\Response Vista del formulario de confirmación
     */
    public function show(): Response
    {
        return Inertia::render('Auth/ConfirmPassword');
    }

    /**
     * Confirma la contraseña del usuario.
     * Valida las credenciales y marca la sesión como con contraseña confirmada.
     *
     * @param \Illuminate\Http\Request $request Contraseña a confirmar
     * @return \Illuminate\Http\RedirectResponse Redirecciona al dashboard o muestra error
     * @throws \Illuminate\Validation\ValidationException Si la contraseña es incorrecta
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
