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
        // Crear usuario administrador por defecto
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mitienda.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Crear usuario demo
        User::create([
            'name' => 'User',
            'email' => 'user@mitienda.com',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);
    }
}
