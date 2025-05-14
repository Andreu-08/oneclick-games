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
            'nickname' => 'Admin',
            'pin' => Hash::make('1234'),
            'is_admin' => true,
        ]);
    }
}
