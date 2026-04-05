<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */public function run(): void
{
    // C'est ici qu'on dit à Laravel d'exécuter ton seeder de clients
    $this->call([
        ClientSeeder::class,
    ]);
}
}
