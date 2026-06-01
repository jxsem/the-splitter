<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo de Usuario
 *
 * Representa a un usuario autenticado en la aplicación. Cada usuario puede ser propietario
 * de múltiples suscripciones compartidas que gestiona con otros miembros.
 *
 * @author The Splitter Team
 *
 * @since 1.0.0
 *
 * @property int $id Identificador único
 * @property string $name Nombre del usuario
 * @property string $email Email único (credencial de autenticación)
 * @property string|null $email_verified_at Timestamp de verificación de email
 * @property string $password Contraseña hasheada
 * @property string|null $remember_token Token para recordar sesión
 * @property Carbon $created_at Fecha de creación del usuario
 * @property Carbon $updated_at Última fecha de actualización
 *
 * @method static \Database\Factories\UserFactory factory() Create a new factory instance
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
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
     * @return HasMany Relación HasMany con Subscription
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
