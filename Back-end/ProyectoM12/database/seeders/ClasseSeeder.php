<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classes')->insert([
            // Clases de D&D
            ['nom' => 'Guerrer', 'descripcio' => 'Combatent cos a cos.', 'joc_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Mag', 'descripcio' => 'Usuari de màgia.', 'joc_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Clergue', 'descripcio' => 'Sanador i suport.', 'joc_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // Clases de Warhammer
            ['nom' => 'Soldat', 'descripcio' => 'Combatent militar.', 'joc_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Hechicero', 'descripcio' => 'Usuari de màgia fosca.', 'joc_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Mercenari', 'descripcio' => 'Guerrer a sou.', 'joc_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            
            // Clases de Pathfinder
            ['nom' => 'Explorador', 'descripcio' => 'Especialista en exploració.', 'joc_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Invocador', 'descripcio' => 'Usuari de màgia invocadora.', 'joc_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Bàrbar', 'descripcio' => 'Combatent salvatge.', 'joc_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
