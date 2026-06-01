<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Member;
use App\Models\Subscription;

/**
 * @class DatabaseSeeder
 * @package Database\Seeders
 * @description Seeder principal de la base de datos.
 * Puebla la base de datos con datos iniciales incluyendo servicios disponibles.
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Ejecuta el seed de la base de datos.
     * Crea un conjunto de servicios/plataformas de streaming disponibles.
     *
     * @return void
     */
    public function run(): void
    {
        $plataformas = [
        'Netflix', 'Spotify', 'Disney+', 'HBO Max', 'Amazon Prime', 
        'YouTube Premium', 'Apple TV+', 'SkyShowtime', 'DAZN', 
        'Filmin', 'Crunchyroll', 'Nintendo Switch Online', 'PlayStation Plus', 
        'Xbox Game Pass', 'Canva Pro', 'ChatGPT Plus', 'Claude Pro'
    ];

    foreach ($plataformas as $p) {
        \App\Models\Service::firstOrCreate(['name' => $p]);
    }
    }
        
}
