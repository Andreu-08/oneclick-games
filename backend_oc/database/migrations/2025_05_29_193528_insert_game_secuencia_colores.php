<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use App\Models\Game;

return new class extends Migration
{
    public function up(): void
    {
        Game::where('title', 'Secuencia de Colores')->delete();

        Game::create([
            'title' => 'Secuencia de Colores',
            'description' => 'Repite la secuencia de colores mostrada en pantalla.',
            'is_active' => true,
            'difficulty_levels' => ['fácil'],
            'image_url' => env('APP_URL', 'http://localhost:8000') . '/images/games/secuencia_colores.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Game::where('title', 'Secuencia de Colores')->delete();
    }
};
