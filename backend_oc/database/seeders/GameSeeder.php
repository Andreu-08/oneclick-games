<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::create([
            'title' => 'Juego de Memoria',
            'description' => 'Encuentra las parejas lo más rápido posible',
            'is_active' => true,
            'difficulty_levels' => null,
        ]);

        Game::create([
            'title' => 'Juego de Reflejos',
            'description' => 'Haz clic cuando veas la señal',
            'is_active' => true,
            'difficulty_levels' => ['fácil', 'difícil'],
        ]);
    }
}
