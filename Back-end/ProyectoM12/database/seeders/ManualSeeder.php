<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('manuals')->insert([
            [
                'nom' => 'Dungeons & Dragons',
                'tipus' => 'Rol',
                'descripcio' => 'Un joc de rol clàssic amb aventures èpiques.',
                'jugabilidad' => 'Exploració, combat tàctic i narrativa.',
                'imatge' => 'dungeonAndDragons.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Warhammer Fantasy',
                'tipus' => 'Rol',
                'descripcio' => 'Un món fosc i brutal ple de guerra i màgia.',
                'jugabilidad' => 'Combat tàctic i narrativa fosca.',
                'imatge' => 'warhammerFantasy.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Pathfinder',
                'tipus' => 'Rol',
                'descripcio' => 'Un joc de rol amb un sistema profund i personalitzable.',
                'jugabilidad' => 'Exploració, combat tàctic i narrativa.',
                'imatge' => 'pathfinder.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}