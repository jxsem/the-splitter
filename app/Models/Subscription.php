<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @class Subscription
 * @package App\Models
 * @description Modelo de suscripción. Actúa como el "pegamento" central conectando usuarios, servicios y miembros.
 * Representa una suscripción a un servicio que puede ser compartida entre múltiples personas.
 * @property int $id Identificador único de la suscripción
 * @property int $user_id Identificador del usuario propietario
 * @property int $service_id Identificador del servicio suscrito
 * @property float $price Precio total de la suscripción
 * @property \Carbon\Carbon $renewal_date Fecha de renovación de la suscripción
 * @property string $period Período de renovación (monthly, trimesterly, annually)
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de última actualización
 */
class Subscription extends Model
{
    protected $fillable = ['user_id', 'service_id', 'price', 'renewal_date', 'period'];
    protected $casts = ['renewal_date' => 'date'];
    /**
     * Obtiene el usuario propietario de esta suscripción.
     * Una suscripción pertenece a un único usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relación BelongsTo con User
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el servicio de esta suscripción.
     * Una suscripción pertenece a un único servicio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relación BelongsTo con Service
     */
    public function service() {
        return $this->belongsTo(Service::class);
    }

    /**
     * Obtiene todos los miembros que comparten esta suscripción.
     * Una suscripción puede tener muchos miembros.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relación HasMany con Member
     */
    public function members() {
        return $this->hasMany(Member::class);
    }

    /**
     * Calcula el número total de personas que comparten esta suscripción.
     * Incluye al propietario más todos los miembros añadidos.
     *
     * @return int Número total de personas (propietario + miembros)
     */
    public function getTotalPeopleAttribute()
    {
        return 1 + $this->members()->count();
    }

    /**
     * Calcula el costo que debe pagar cada persona que comparte la suscripción.
     * Divide el precio total entre el número total de personas.
     *
     * @return float Precio por persona (precio total / total de personas)
     */
    public function getPricePerPersonAttribute()
    {
        $totalPeople = 1 + $this->members()->count();
        return $this->price / $totalPeople;
    }
}
