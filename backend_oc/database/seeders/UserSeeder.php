<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 9 usuarios normales
        User::factory()->count(25)->create();

        // Crear un usuario admin fijo
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@oneclick',
            'password' => 'admin123', // se hashea automáticamente por el modelo
            'is_admin' => true,
        ]);
    }
}
