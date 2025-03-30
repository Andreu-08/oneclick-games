<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->word() . ' Game',
            'description' => $this->faker->sentence(),
            'is_active' => true,
            'difficulty_levels' => [
                'easy' => ['max_time' => 60],
                'hard' => ['max_time' => 30],
            ],
        ];
    }
}
