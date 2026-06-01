<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

/**
 * @class AppServiceProvider
 * @package App\Providers
 * @description Service provider principal de la aplicación.
 * Registra servicios y bootstraps de configuración globales de la aplicación.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra cualquier servicio de la aplicación.
     * Este método se ejecuta antes de registrar otros providers.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstraps los servicios de la aplicación.
     * Este método se ejecuta después de que todos los providers hayan sido registrados.
     * Configura prefetch de assets con Vite.
     *
     * @return void
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
