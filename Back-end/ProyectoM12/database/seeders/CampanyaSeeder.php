<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampanyaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('campanyes')->insert([
            ['nom' => 'La Tomba dels Horrors', 'descripcio' => 'Una aventura mortal.', 'estat' => 'activa', 'user_id' => 2, 'joc_id' => 1, 'personatges' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'La Tempesta del Caos', 'descripcio' => 'Una guerra èpica.', 'estat' => 'activa', 'user_id' => 2, 'joc_id' => 2, 'personatges' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Els Reis Oblidats', 'descripcio' => 'Una recerca antiga.', 'estat' => 'activa', 'user_id' => 2, 'joc_id' => 3, 'personatges' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}