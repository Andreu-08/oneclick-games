<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use App\Models\Game;

return new class extends Migration
{
    public function up(): void
    {
        Game::where('title', 'Encuentra el Número')->delete();

        Game::create([
            'title' => 'Encuentra el Número',
            'description' => 'Encuentra el número correcto entre los que aparecen en pantalla.',
            'is_active' => true,
            'difficulty_levels' => ['fácil'],
            'image_url' => env('APP_URL', 'http://localhost:8000') . '/images/games/encuentra_numero.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Game::where('title', 'Encuentra el Número')->delete();
    }
};
