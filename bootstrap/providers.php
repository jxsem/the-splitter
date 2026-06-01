<?php

/**
 * @file bootstrap/providers.php
 * @description Registro de Service Providers de la aplicación.
 * Define todos los providers que se ejecutarán durante el bootstrapping de la aplicación.
 */

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
];
