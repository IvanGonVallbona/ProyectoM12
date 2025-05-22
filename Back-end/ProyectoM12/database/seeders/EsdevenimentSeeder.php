<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EsdevenimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('esdeveniments')->insert([
            [
                'nom' => 'Torneig de Magic',
                'descripcio' => 'Un torneig de Magic: The Gathering',
                'data' => now()->addDays(7),
                'tipus' => 'Torneig',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Torneig de Pokémon',
                'descripcio' => 'Un torneig de Pokémon TCG',
                'data' => now()->addDays(14),
                'tipus' => 'Torneig',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}