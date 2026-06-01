<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo de Servicio
 *
 * Representa una plataforma o servicio de suscripción (Netflix, Spotify, etc.)
 * que puede ser compartida entre múltiples usuarios. Define el precio base y
 * la información general del servicio.
 *
 * @author The Splitter Team
 *
 * @since 1.0.0
 *
 * @property int $id Identificador único del servicio
 * @property string $name Nombre del servicio (ej: Netflix, Spotify)
 * @property float $price Precio mensual del servicio
 * @property Carbon $created_at Fecha de creación del registro
 * @property Carbon $updated_at Última fecha de actualización
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 */
class Service extends Model
{
    protected $fillable = ['name', 'price'];

    /**
     * Obtiene todas las suscripciones de este servicio.
     * Un servicio puede tener muchas suscripciones.
     *
     * @return HasMany Relación HasMany con Subscription
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
