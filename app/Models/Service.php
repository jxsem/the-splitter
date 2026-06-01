<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @class Service
 * @package App\Models
 * @description Modelo de servicio. Representa una plataforma o servicio (Netflix, Spotify, etc.) que puede ser compartido.
 * @property int $id Identificador único del servicio
 * @property string $name Nombre del servicio
 * @property float $price Precio del servicio
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de última actualización
 */
class Service extends Model
{
    protected $fillable = ['name', 'price'];

    /**
     * Obtiene todas las suscripciones de este servicio.
     * Un servicio puede tener muchas suscripciones.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relación HasMany con Subscription
     */
    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }
}
