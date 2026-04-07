<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
        return redirect()->route('subscriptions.index');
    })->name('dashboard');


Route::middleware('auth')->group(function () {
    // Listado y creación de suscripciones
    Route::get('/mis-suscripciones', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/nueva-suscripcion', [SubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::post('/nueva-suscripcion', [SubscriptionController::class, 'store'])->name('subscriptions.store');

    // ESTA ES LA RUTA QUE TE FALTA (La que causa el error)
    Route::get('/suscripcion/{subscription}', [SubscriptionController::class, 'show'])->name('subscriptions.show');

    // Ruta para añadir amigos (miembros)
    Route::post('/suscripcion/{subscription}/miembros', [MemberController::class, 'store'])->name('members.store');

    //Elminar miembros
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');

    //Eliminar subscripciones
    Route::delete('/suscripcion/{subscription}', [SubscriptionController::class, 'destroy'])->name('subscriptions.destroy');
});
require __DIR__.'/auth.php';
