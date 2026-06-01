<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

/**
 * @class RegisteredUserController
 * @package App\Http\Controllers\Auth
 * @description Controlador para manejar el registro de nuevos usuarios.
 * Muestra el formulario de registro y procesa las solicitudes de registro.
 */
class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista del formulario de registro.
     *
     * @return \Inertia\Response Vista del formulario de registro
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Procesa una solicitud de registro de nuevo usuario.
     * Valida los datos, crea el usuario y lo autentica.
     *
     * @param \Illuminate\Http\Request $request Datos del formulario de registro
     * @return \Illuminate\Http\RedirectResponse Redirecciona al dashboard
     * @throws \Illuminate\Validation\ValidationException Si la validación falla
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
