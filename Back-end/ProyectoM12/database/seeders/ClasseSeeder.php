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
            [
                'nom' => 'Guerrer',
                'descripcio' => 'Especialitzat en combat cos a cos i resistència.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Mag',
                'descripcio' => 'Utilitza encanteris per atacar i defensar-se.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Arquer',
                'descripcio' => 'Expert en combat a distància amb arcs i fletxes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Clergue',
                'descripcio' => 'Especialitzat en curació i suport als aliats.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Assassí',
                'descripcio' => 'Expert en furtivitat i atacs ràpids.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Barbar',
                'descripcio' => 'Combatent salvatge amb gran força física.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
