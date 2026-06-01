<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @class GuestLayout
 * @package App\View\Components
 * @description Componente layout para usuarios no autenticados.
 * Proporciona la estructura base para páginas públicas (login, registro, etc.).
 */
class GuestLayout extends Component
{
    /**
     * Obtiene la vista/contenido que representa el componente.
     * Renderiza el layout para usuarios no autenticados.
     *
     * @return \Illuminate\View\View Vista del layout
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
