<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseCampanyaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classe_campanya')->insert([
            ['campanya_id' => 1, 'classe_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['campanya_id' => 1, 'classe_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['campanya_id' => 1, 'classe_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['campanya_id' => 2, 'classe_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['campanya_id' => 2, 'classe_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['campanya_id' => 2, 'classe_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['campanya_id' => 3, 'classe_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['campanya_id' => 3, 'classe_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['campanya_id' => 3, 'classe_id' => 8, 'created_at' => now(), 'updated_at' => now()],
        ]);


    }
}