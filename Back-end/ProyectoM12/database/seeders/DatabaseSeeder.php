<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ManualSeeder::class,
            ClasseSeeder::class,
            RazaSeeder::class,
            CampanyaSeeder::class,
            PersonatgeSeeder::class,
            EsdevenimentSeeder::class,
            ClasseCampanyaSeeder::class,
            RegistreSeeder::class,
        ]);

    }
}
