<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function store(Request $request, Subscription $subscription)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Creamos el miembro dentro de esta suscripción específica
        $subscription->members()->create([
            'name' => $request->name,
        ]);

        return back()->with('success', '¡Miembro añadido!');
    }
   
    

        // Verificamos que la suscripción del miembro pertenece al usuario autenticado
    public function destroy(Member $member)
    {
            // Solo borramos el registro de la tabla 'members'
            $member->delete();

            return back()->with('success', 'Miembro eliminado.');
    }    

}