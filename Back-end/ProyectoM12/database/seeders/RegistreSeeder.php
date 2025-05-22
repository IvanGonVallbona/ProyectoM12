<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('registres')->insert([
            [
                'titol' => 'Inici de la campanya',
                'descripcio' => 'Els aventurers es reuneixen a la taverna per començar la seva missió.',
                'campanya_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titol' => 'Descobriment del mapa',
                'descripcio' => 'Troben un mapa antic que els portarà a una nova aventura.',
                'campanya_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titol' => 'Sessió 1',
                'descripcio' => 'Els herois es coneixen i reben la seva primera missió.',
                'campanya_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titol' => 'Sessió 2',
                'descripcio' => 'Exploren les ruïnes i troben pistes importants.',
                'campanya_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titol' => 'Sessió 3',
                'descripcio' => 'S’enfronten al primer gran enemic de la campanya.',
                'campanya_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}