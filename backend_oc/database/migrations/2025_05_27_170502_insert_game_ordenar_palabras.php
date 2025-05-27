<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use App\Models\Game;

return new class extends Migration
{
    public function up(): void
    {
        Game::where('title', 'Ordenar Palabras')->delete();

        Game::create([
            'title' => 'Ordenar Palabras',
            'description' => 'Coloca las palabras en el orden correcto',
            'is_active' => true,
            'difficulty_levels' => ['fácil', 'normal'],
            'image_url' => env('APP_URL', 'http://localhost:8000') . '/images/games/ordenar_palabras.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Game::where('title', 'Ordenar Palabras')->delete();
    }
};
