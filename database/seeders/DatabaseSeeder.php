<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Member;
use App\Models\Subscription;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
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
