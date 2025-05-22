<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonatgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personatges')->insert([
            // Personatges de D&D
            ['nom' => 'Arthas', 'nivell' => 5, 'classe_id' => 1, 'raza_id' => 1, 'user_id' => 2, 'campanya_id' => 1, 'joc_id' => 1, 'imatge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Lyra', 'nivell' => 3, 'classe_id' => 2, 'raza_id' => 2, 'user_id' => 3, 'campanya_id' => 1, 'joc_id' => 1, 'imatge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Dorn', 'nivell' => 2, 'classe_id' => 3, 'raza_id' => 3, 'user_id' => 3, 'campanya_id' => null, 'joc_id' => 1, 'imatge' => null, 'created_at' => now(), 'updated_at' => now()],
            
            // Personatges de Warhammer
            ['nom' => 'Sigmar', 'nivell' => 4, 'classe_id' => 4, 'raza_id' => 4, 'user_id' => 2, 'campanya_id' => 2, 'joc_id' => 2, 'imatge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Morgana', 'nivell' => 3, 'classe_id' => 5, 'raza_id' => 5, 'user_id' => 3, 'campanya_id' => 2, 'joc_id' => 2, 'imatge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Ulric', 'nivell' => 2, 'classe_id' => 6, 'raza_id' => 6, 'user_id' => 3, 'campanya_id' => null, 'joc_id' => 2, 'imatge' => null, 'created_at' => now(), 'updated_at' => now()],
            
            // Personatges de Pathfinder
            ['nom' => 'Kael', 'nivell' => 5, 'classe_id' => 7, 'raza_id' => 7, 'user_id' => 4, 'campanya_id' => 3, 'joc_id' => 3, 'imatge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Selene', 'nivell' => 4, 'classe_id' => 8, 'raza_id' => 8, 'user_id' => 3, 'campanya_id' => 3, 'joc_id' => 3, 'imatge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Tharok', 'nivell' => 3, 'classe_id' => 9, 'raza_id' => 9, 'user_id' => 3, 'campanya_id' => null, 'joc_id' => 3, 'imatge' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}