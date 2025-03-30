<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Score;
use App\Models\User;
use App\Models\Game;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Score>
 */
class ScoreFactory extends Factory
{
    protected $model = Score::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'game_id' => Game::inRandomOrder()->first()?->id ?? Game::factory(),
            'score' => $this->faker->numberBetween(0, 1000),
            'meta' => [
                'errores' => $this->faker->numberBetween(0, 5),
                'movimientos' => $this->faker->numberBetween(5, 20),
            ],
            'duration' => $this->faker->numberBetween(10, 300), // segundos
        ];
    }
}
