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
        // Crear un usuario admin fijo
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@oneclick',
            'password' => 'admin123',
            'pin' => '1234',
            'is_admin' => true,
        ]);
    }
}
