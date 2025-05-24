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
        foreach (range(1, 50) as $i) {
            User::create([
                'nickname' => 'Jugador_' . $i,
                'pin' => Hash::make('1234'),
                'is_admin' => false,
            ]);
        }
    }
}
