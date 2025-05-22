<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RazaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('razas')->insert([
            // Razas de D&D
            ['nom' => 'Humà', 'descripcio' => 'Versàtil i adaptatiu.', 'joc_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Elf', 'descripcio' => 'Elegant i màgic.', 'joc_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Nan', 'descripcio' => 'Robust i tenaç.', 'joc_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // Razas de Warhammer
            ['nom' => 'Humà', 'descripcio' => 'Habitant de l’Imperi.', 'joc_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Orc', 'descripcio' => 'Guerrer brutal.', 'joc_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Caos', 'descripcio' => 'Servent dels déus foscos.', 'joc_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            
            // Razas de Pathfinder
            ['nom' => 'Humà', 'descripcio' => 'Versàtil i equilibrat.', 'joc_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Gnom', 'descripcio' => 'Petit i màgic.', 'joc_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Mitjà', 'descripcio' => 'Petit i àgil.', 'joc_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
