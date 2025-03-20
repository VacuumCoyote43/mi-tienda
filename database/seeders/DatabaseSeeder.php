<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios, categorías y características antes que los productos
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            CharacteristicSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
