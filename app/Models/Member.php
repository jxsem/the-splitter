<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo de Miembro
 *
 * Representa a una persona que comparte una suscripción
 * (familia, amigos del usuario propietario). Cada miembro se asocia
 * con una única suscripción y contribuye al costo compartido.
 *
 * @author The Splitter Team
 *
 * @since 1.0.0
 *
 * @property int $id Identificador único del miembro
 * @property int $subscription_id Identificador de la suscripción a la que pertenece
 * @property string $name Nombre completo del miembro
 * @property Carbon $created_at Fecha de creación del registro
 * @property Carbon $updated_at Última fecha de actualización
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member query()
 */
class Member extends Model
{
    use HasFactory;

    // Solo necesitamos saber a qué suscripción pertenece y cómo se llama
    protected $fillable = ['subscription_id', 'name'];

    /**
     * Obtiene la suscripción a la que pertenece este miembro.
     * Un miembro pertenece a una única suscripción.
     *
     * @return BelongsTo Relación BelongsTo con Subscription
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
