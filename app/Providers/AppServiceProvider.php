<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    // Forzamos la redirección tras el Login y el Registro
    \Illuminate\Support\Facades\Event::listen(
        [\Illuminate\Auth\Events\Login::class, \Illuminate\Auth\Events\Registered::class],
        function ($event) {
            session(['url.intended' => route('subscriptions.index')]);
        }
    );

    if (app()->environment('production')) {
        \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}
}
