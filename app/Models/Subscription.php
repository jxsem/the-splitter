<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Este modelo es el "pegamento de la aplicacion"
// Se conecta a usuario, a servicio y a miembros
class Subscription extends Model
{
    protected $fillable = ['user_id', 'service_id', 'price', 'renewal_date', 'period'];

    public function user() {
    return $this->belongsTo(User::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function members() {
        return $this->hasMany(Member::class);
    }

    /**
     * Calcula cuánta gente hay en total (Tú + tus amigos)
     */
    public function getTotalPeopleAttribute()
    {
        // 1 (Jose Manuel) + el número de miembros en la tabla members
        return 1 + $this->members()->count();
    }

    /**
     * Calcula cuánto debe pagar cada uno
     */
    public function getPricePerPersonAttribute()
    {
        $totalPeople = 1 + $this->members()->count();
        return $this->price / $totalPeople;
    }
}
