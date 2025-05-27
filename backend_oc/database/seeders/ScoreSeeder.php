<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Score;

class ScoreSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id'); // Todos los usuarios existentes
        $gameIds = range(1, 8); // 8 juegos fijos

        foreach ($userIds as $userId) {
            foreach ($gameIds as $gameId) {
                foreach (range(1, rand(1, 3)) as $i) {
                    Score::create([
                        'user_id' => $userId,
                        'game_id' => $gameId,
                        'score' => rand(100, 1000),
                        'duration' => rand(30, 300),
                        'meta' => null,
                    ]);
                }
            }
        }
    }
}
