<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @class Member
 * @package App\Models
 * @description Modelo de miembro. Representa a una persona que comparte una suscripción (amigos del usuario propietario).
 * @property int $id Identificador único del miembro
 * @property int $subscription_id Identificador de la suscripción a la que pertenece
 * @property string $name Nombre del miembro
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de última actualización
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relación BelongsTo con Subscription
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
