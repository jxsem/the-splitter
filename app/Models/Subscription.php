<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo de Suscripción
 *
 * Actúa como el punto central conectando usuarios, servicios y miembros.
 * Representa una suscripción a un servicio que puede ser compartida entre múltiples personas.
 * Gestiona el precio total, la fecha de renovación y el período de pago.
 *
 * @author The Splitter Team
 *
 * @since 1.0.0
 *
 * @property int $id Identificador único de la suscripción
 * @property int $user_id Identificador del usuario propietario
 * @property int $service_id Identificador del servicio suscrito
 * @property float $price Precio total de la suscripción (puede diferir del precio base del servicio)
 * @property Carbon|\Illuminate\Support\Carbon $renewal_date Fecha de próxima renovación
 * @property string $period Período de renovación: monthly, trimesterly, annually
 * @property Carbon $created_at Fecha de creación del registro
 * @property Carbon $updated_at Última fecha de actualización
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription query()
 */
class Subscription extends Model
{
    protected $fillable = ['user_id', 'service_id', 'price', 'renewal_date', 'period'];

    protected $casts = ['renewal_date' => 'date'];

    /**
     * Obtiene el usuario propietario de esta suscripción.
     * Una suscripción pertenece a un único usuario.
     *
     * @return BelongsTo Relación BelongsTo con User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el servicio de esta suscripción.
     * Una suscripción pertenece a un único servicio.
     *
     * @return BelongsTo Relación BelongsTo con Service
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Obtiene todos los miembros que comparten esta suscripción.
     * Una suscripción puede tener muchos miembros.
     *
     * @return HasMany Relación HasMany con Member
     */
    public function members()
    {
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
