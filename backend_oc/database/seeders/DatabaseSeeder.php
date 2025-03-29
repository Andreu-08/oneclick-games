<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 10 usuarios asegurando que los nombres y correos sean únicos
        User::factory(10)->create([
            'name' => fake()->unique()->name(),
            'email' => function () {
                do {
                    $email = fake()->unique()->email();
                } while (User::where('email', $email)->exists());
                return $email;
            },
        ]);
    }
}
