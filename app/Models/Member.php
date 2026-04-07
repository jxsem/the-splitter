<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Solo necesitamos saber a qué suscripción pertenece y cómo se llama
    protected $fillable = ['subscription_id', 'name'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
