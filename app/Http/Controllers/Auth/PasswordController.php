<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * @class PasswordController
 * @package App\Http\Controllers\Auth
 * @description Controlador para cambio de contraseña del usuario autenticado.
 * Procesa solicitudes de actualización de contraseña.
 */
class PasswordController extends Controller
{
    /**
     * Actualiza la contraseña del usuario autenticado.
     * Valida la contraseña actual antes de cambiarla.
     *
     * @param \Illuminate\Http\Request $request Contraseñas actual y nueva
     * @return \Illuminate\Http\RedirectResponse Redirecciona hacia atrás
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back();
    }
}
