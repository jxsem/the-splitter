<?php

/**
 * @file routes/console.php
 * @description Define comandos Artisan personalizados para la aplicación.
 * Registra el comando 'inspire' que muestra citas inspiradoras.
 */

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/**
 * Comando Artisan personalizado 'inspire'.
 * Muestra una cita inspiradora en la consola.
 */
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
