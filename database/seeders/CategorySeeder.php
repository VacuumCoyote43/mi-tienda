<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Camisetas', 'description' => 'Todo tipo de camisetas y tops'],
            ['name' => 'Pantalones', 'description' => 'Jeans, chinos, shorts y más'],
            ['name' => 'Vestidos', 'description' => 'Vestidos para toda ocasión'],
            ['name' => 'Faldas', 'description' => 'Faldas cortas, largas y midi'],
            ['name' => 'Abrigos', 'description' => 'Chaquetas, abrigos y cazadoras'],
            ['name' => 'Sudaderas', 'description' => 'Sudaderas y hoodies'],
            ['name' => 'Ropa Deportiva', 'description' => 'Ropa para hacer deporte y actividades físicas'],
            ['name' => 'Ropa Interior', 'description' => 'Ropa interior y lencería'],
            ['name' => 'Trajes', 'description' => 'Trajes formales y conjuntos'],
            ['name' => 'Accesorios', 'description' => 'Cinturones, bufandas, gorros y más'],
            ['name' => 'Zapatos', 'description' => 'Todo tipo de calzado'],
            ['name' => 'Ropa de Baño', 'description' => 'Bañadores y bikinis'],
            ['name' => 'Pijamas', 'description' => 'Ropa de dormir y estar por casa'],
            ['name' => 'Ropa Formal', 'description' => 'Ropa elegante para ocasiones especiales'],
            ['name' => 'Ropa Casual', 'description' => 'Ropa informal para el día a día'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
