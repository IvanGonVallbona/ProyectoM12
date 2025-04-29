<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuari administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Dungeon Master',
            'email' => 'dm@example.com',
            'password' => Hash::make('password'),
        ]);

        // Usuari normal 1
        User::create([
            'name' => 'Player One',
            'email' => 'player1@example.com',
            'password' => Hash::make('password'),
        ]);

        // Usuari normal 2
        User::create([
            'name' => 'Player Two',
            'email' => 'player2@example.com',
            'password' => Hash::make('password'),
        ]);
        

    }
}
