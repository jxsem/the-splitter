<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Subscription;

/**
 * @class User
 * @package App\Models
 * @description Modelo de usuario. Representa a un usuario autenticado en la aplicación con sus suscripciones asociadas.
 * @extends Authenticatable
 */
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Define los tipos de casting para los atributos del modelo.
     *
     * @return array<string, string> Array de casting de atributos
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Obtiene todas las suscripciones del usuario.
     * Un usuario puede tener muchas suscripciones.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relación HasMany con Subscription
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
