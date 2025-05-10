<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('admin123'), // contraseña por si la usas en futuro
            'pin' => Hash::make('1234'),          // el pin también debe estar hasheado
            'is_admin' => true,
        ]);
    }
}
