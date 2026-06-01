<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @class SubscriptionController
 * @package App\Http\Controllers
 * @description Controlador para gestionar las operaciones CRUD de suscripciones del usuario autenticado.
 * Maneja la visualización, creación, almacenamiento, lectura y eliminación de suscripciones.
 */
class SubscriptionController extends Controller
{
    /**
     * Muestra la lista de todas las suscripciones del usuario autenticado.
     * Carga las relaciones asociadas (servicio y miembros) de forma optimizada.
     *
     * @return \Illuminate\View\View Vista con la lista de suscripciones
     */
    public function index()
    {
        $subscriptions = Subscription::where('user_id', Auth::id())
            ->with(['service', 'members'])
            ->get();

        return view('subscriptions.index', compact('subscriptions'));
    }

    /**
     * Muestra el formulario para crear una nueva suscripción.
     * Carga todos los servicios disponibles para mostrar en el formulario.
     *
     * @return \Illuminate\View\View Vista con el formulario de creación
     */
    public function create()
    {
        $services = Service::all();
        return view('subscriptions.create', compact('services'));
    }

    /**
     * Guarda una nueva suscripción en la base de datos.
     * Valida los datos del formulario y asocia la suscripción al usuario autenticado.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud con los datos validados
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de suscripciones
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id'   => 'required|exists:services,id',
            'price'        => 'required|numeric|min:0',
            'period'       => 'required|in:monthly,trimesterly,annually',
            'renewal_date' => 'required|date',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->subscriptions()->create($validated);

        return redirect()->route('subscriptions.index')
            ->with('success', '¡Suscripción guardada con éxito!');
    }


    /**
     * Muestra la página de gestión individual de una suscripción.
     * Carga todos los miembros asociados a la suscripción.
     *
     * @param \App\Models\Subscription $subscription Suscripción a mostrar (inyectada por modelo)
     * @return \Illuminate\View\View Vista de detalle de la suscripción
     */
    public function show(Subscription $subscription)
    {
        $subscription->load('members');
        return view('subscriptions.show', compact('subscription'));
    }

    /**
     * Elimina una suscripción de la base de datos.
     * Verifica que la suscripción pertenezca al usuario autenticado antes de eliminarla.
     * También elimina todos los miembros asociados a través de cascada.
     *
     * @param \App\Models\Subscription $subscription Suscripción a eliminar
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de suscripciones
     * @throws \Illuminate\Auth\Access\AuthorizationException Si no tiene permiso para eliminar
     */
    public function destroy(Subscription $subscription)
    {
        if ($subscription->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para hacer esto.');
        }

        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Suscripción eliminada con éxito.');
    }
}


