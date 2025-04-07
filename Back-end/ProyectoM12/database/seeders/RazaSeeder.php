<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Raza;

class RazaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Raza::create([
            'nom' => 'Humà',
            'descripcio' => 'Una raça versàtil i adaptativa, amb habilitats equilibrades.',
        ]);

        Raza::create([
            'nom' => 'Elf',
            'descripcio' => 'Una raça elegant i màgica, coneguda per la seva longevitat i saviesa.',
        ]);

        Raza::create([
            'nom' => 'Nan',
            'descripcio' => 'Una raça robusta i tenaç, amb una gran habilitat per a la mineria i la forja.',
        ]);

        Raza::create([
            'nom' => 'Orc',
            'descripcio' => 'Una raça forta i guerrera, coneguda per la seva ferocitat en el combat.',
        ]);

        Raza::create([
            'nom' => 'Mitjà',
            'descripcio' => 'Una raça adaptable i equilibrada, amb una gran varietat d’habilitats.',
        ]);
        Raza::create([
            'nom' => 'Draconic',
            'descripcio' => 'Una raça poderosa i majestuosa, amb una gran habilitat per a la màgia i el combat.',
        ]);
    }
}
