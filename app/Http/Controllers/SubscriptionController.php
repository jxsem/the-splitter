<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Muestra la lista de suscripciones del usuario logueado.
     */
    public function index()
    {
        // Traemos solo las suscripciones que pertenecen al ID de Jose Manuel (ID 1)
        $subscriptions = Subscription::where('user_id', Auth::id())
            ->with(['service', 'members']) // Carga optimizada de relaciones
            ->get();

        return view('subscriptions.index', compact('subscriptions'));
    }

    /**
     * Muestra el formulario para crear una nueva suscripción.
     */
    public function create()
    {
        // Necesitamos todos los servicios (Netflix, Spotify...) para el desplegable
        $services = Service::all();

        // Si la tabla de servicios está vacía, esto mandará una colección vacía a la vista
        return view('subscriptions.create', compact('services'));
    }

    /**
     * Guarda la nueva suscripción en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación: Si algo falta, Laravel te devuelve al formulario automáticamente
        $validated = $request->validate([
            'service_id'   => 'required|exists:services,id',
            'price'        => 'required|numeric|min:0',
            'period'       => 'required|in:monthly,trimesterly,annually',
            'renewal_date' => 'required|date',
        ]);

        // 2. Guardado: Creamos la suscripción vinculada al usuario autenticado
        // Esto asume que tienes la relación definida en el modelo User
        auth()->user()->subscriptions()->create($validated);

        // 3. Redirección: Al terminar, volvemos a la lista con un mensaje de éxito
        return redirect()->route('subscriptions.index')
            ->with('success', '¡Suscripción guardada con éxito!');
    }


    /**
     * Muestra la página de gestión individual de una suscripción
     */
    public function show(Subscription $subscription)
    {
        // Cargamos los amigos (miembros) asociados a esta suscripción
        $subscription->load('members');

        // Retornamos la vista 'show' que creamos antes
        return view('subscriptions.show', compact('subscription'));
    }

    /**
     * Elimina una suscripción.
     */
    public function destroy(Subscription $subscription)
{
    // Seguridad: Si la suscripción no es mía, fuera.
    if ($subscription->user_id !== auth()->id()) {
        abort(403, 'No tienes permiso para hacer esto.');
    }

    // Al borrar la suscripción, Laravel borrará también los miembros 
    // SI tienes puesto el "onDelete('cascade')" en la base de datos.
    $subscription->delete();

    return redirect()->route('subscriptions.index')
        ->with('success', 'Suscripción eliminada con éxito.');
}
}


