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
    
    \Illuminate\Support\Facades\Event::listen(
        [\Illuminate\Auth\Events\Login::class, \Illuminate\Auth\Events\Registered::class],
        function ($event) {
            session(['url.intended' => route('subscriptions.index')]);
        }
    );

    // 
    // Forzamos HTTPS si: la APP_ENV es production O si Render nos dice que es HTTPS
    if (config('app.env') === 'production' || 
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
        \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}
}
