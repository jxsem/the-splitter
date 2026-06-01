<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

/**
 * @class HandleInertiaRequests
 * @package App\Http\Middleware
 * @description Middleware que configura y maneja las propiedades compartidas de Inertia.js.
 * Define el template raíz y las propiedades compartidas entre frontend y backend.
 */
class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determina la versión del asset actual.
     * Utilizado por Inertia para validar cachés en el cliente.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud HTTP
     * @return string|null Versión del asset o null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define las propiedades que se comparten por defecto con todas las páginas de Inertia.
     * Incluye información del usuario autenticado.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud HTTP
     * @return array<string, mixed> Propiedades compartidas
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
        ];
    }
}
