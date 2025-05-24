<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        Game::create([
            'title' => 'Juego de Memoria',
            'description' => 'Encuentra las parejas lo más rápido posible',
            'image_url' => url('/images/games/memoria.png'),
            'is_active' => true,
            'difficulty_levels' => null,
        ]);

        Game::create([
            'title' => 'Juego de Reflejos',
            'description' => 'Haz clic cuando veas la señal',
            'image_url' => url('/images/games/reflejos.png'),
            'is_active' => true,
            'difficulty_levels' => ['fácil', 'difícil'],
        ]);

        Game::create([
            'title' => 'Ordenar Palabras',
            'description' => 'Coloca las palabras en el orden correcto',
            'image_url' => url('/images/games/ordenar_palabras.png'),
            'is_active' => true,
            'difficulty_levels' => ['fácil', 'normal'],
        ]);

        Game::create([
            'title' => 'Secuencia de Colores',
            'description' => 'Repite la secuencia de colores que ves',
            'image_url' => url('/images/games/secuencia_colores.png'),
            'is_active' => true,
            'difficulty_levels' => ['normal', 'difícil'],
        ]);

        Game::create([
            'title' => 'Encuentra el Número',
            'description' => 'Haz clic en el número indicado entre varios',
            'image_url' => url('/images/games/encuentra_numero.png'),
            'is_active' => true,
            'difficulty_levels' => ['fácil'],
        ]);

        Game::create([
            'title' => 'Suma Rápida',
            'description' => 'Resuelve sumas sencillas rápidamente',
            'image_url' => url('/images/games/suma_rapida.png'),
            'is_active' => true,
            'difficulty_levels' => ['fácil', 'media'],
        ]);

        Game::create([
            'title' => 'Dibujo Invisible',
            'description' => 'Recuerda y dibuja una figura sencilla con el teclado',
            'image_url' => url('/images/games/dibujo_invisible.png'),
            'is_active' => true,
            'difficulty_levels' => null,
        ]);

        Game::create([
            'title' => 'Selecciona el Emoji',
            'description' => 'Selecciona el emoji correcto según la emoción',
            'image_url' => url('/images/games/selecciona_emoji.png'),
            'is_active' => true,
            'difficulty_levels' => ['infantil'],
        ]);
    }
}
