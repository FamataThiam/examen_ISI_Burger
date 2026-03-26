<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            [
                'nom' => 'Thiam',
                'prenom' => 'Famata',
                'adresse' => 'Dakar',
                'email' => 'famata@gmail.com',
                'password' => Hash::make('famata'), // mot de passe hashé
                'role' => 'gestionnaire',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Admin1',
                'prenom' => 'System1',
                'adresse' => 'Dakar',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('passer123'), // mot de passe hashé
                'role' => 'gestionnaire',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

}
