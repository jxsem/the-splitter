<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @class AppLayout
 * @package App\View\Components
 * @description Componente layout para la aplicación autenticada.
 * Proporciona la estructura base para todas las páginas protegidas de la aplicación.
 */
class AppLayout extends Component
{
    /**
     * Obtiene la vista/contenido que representa el componente.
     * Renderiza el layout principal de la aplicación autenticada.
     *
     * @return \Illuminate\View\View Vista del layout
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
