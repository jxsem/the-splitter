<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Member;
use Illuminate\Http\Request;

/**
 * @class MemberController
 * @package App\Http\Controllers
 * @description Controlador para gestionar miembros (amigos) que comparten una suscripción.
 * Maneja la creación y eliminación de miembros dentro de una suscripción.
 */
class MemberController extends Controller
{
    /**
     * Almacena un nuevo miembro en una suscripción.
     * Valida el nombre del miembro y lo crea asociado a la suscripción especificada.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud con los datos del miembro
     * @param \App\Models\Subscription $subscription Suscripción a la que pertenece el nuevo miembro
     * @return \Illuminate\Http\RedirectResponse Redirecciona hacia atrás con mensaje de éxito
     */
    public function store(Request $request, Subscription $subscription)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subscription->members()->create([
            'name' => $request->name,
        ]);

        return back()->with('success', '¡Miembro añadido!');
    }
   
    

    /**
     * Elimina un miembro de una suscripción.
     * Borra el registro del miembro de la base de datos.
     *
     * @param \App\Models\Member $member Miembro a eliminar
     * @return \Illuminate\Http\RedirectResponse Redirecciona hacia atrás con mensaje de éxito
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return back()->with('success', 'Miembro eliminado.');
    }    

}