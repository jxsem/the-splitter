<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

/**
 * @class ProfileController
 * @package App\Http\Controllers
 * @description Controlador para gestionar el perfil del usuario autenticado.
 * Maneja la visualización, edición y eliminación de información del perfil de usuario.
 */
class ProfileController extends Controller
{
    /**
     * Muestra el formulario de edición del perfil del usuario.
     * Incluye información sobre si se requiere verificación de email.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud HTTP
     * @return \Inertia\Response Respuesta de Inertia con el componente de edición de perfil
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Actualiza la información del perfil del usuario autenticado.
     * Valida los datos y resetea la verificación de email si el email cambió.
     *
     * @param \App\Http\Requests\ProfileUpdateRequest $request Form Request con datos validados
     * @return \Illuminate\Http\RedirectResponse Redirecciona al formulario de edición
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Elimina la cuenta del usuario autenticado.
     * Requiere la contraseña actual y realiza logout de la sesión.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud con validación de contraseña
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la página principal
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
