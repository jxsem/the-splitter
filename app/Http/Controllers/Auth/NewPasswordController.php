<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

/**
 * @class NewPasswordController
 * @package App\Http\Controllers\Auth
 * @description Controlador para manejar el reset de contraseña.
 * Muestra el formulario de nueva contraseña y procesa el cambio.
 */
class NewPasswordController extends Controller
{
    /**
     * Muestra la vista del formulario de nueva contraseña.
     * Incluye el email y token de reset.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud con token y email
     * @return \Inertia\Response Vista del formulario de reset
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Procesa una solicitud de nueva contraseña.
     * Valida el token y cambia la contraseña del usuario.
     *
     * @param \Illuminate\Http\Request $request Datos del reset (token, email, password)
     * @return \Illuminate\Http\RedirectResponse Redirecciona a login o muestra error
     * @throws \Illuminate\Validation\ValidationException Si la validación falla
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
