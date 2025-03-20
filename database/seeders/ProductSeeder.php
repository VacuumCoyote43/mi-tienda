<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Characteristic;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Camisetas
            ['name' => 'Camiseta Básica Algodón', 'description' => 'Camiseta básica 100% algodón', 'price' => 19.99, 'category_id' => 1],
            ['name' => 'Camiseta Manga Larga', 'description' => 'Camiseta manga larga casual', 'price' => 24.99, 'category_id' => 1],
            ['name' => 'Polo Premium', 'description' => 'Polo de algodón pima', 'price' => 39.99, 'category_id' => 1],
            ['name' => 'Camiseta Estampada', 'description' => 'Camiseta con diseño exclusivo', 'price' => 29.99, 'category_id' => 1],
            ['name' => 'Top Crop', 'description' => 'Top corto para verano', 'price' => 15.99, 'category_id' => 1],
            
            // Pantalones
            ['name' => 'Jeans Clásicos', 'description' => 'Jeans rectos de mezclilla', 'price' => 49.99, 'category_id' => 2],
            ['name' => 'Pantalón Chino', 'description' => 'Pantalón casual elegante', 'price' => 44.99, 'category_id' => 2],
            ['name' => 'Shorts Deportivos', 'description' => 'Shorts ligeros para deporte', 'price' => 29.99, 'category_id' => 2],
            ['name' => 'Pantalón de Vestir', 'description' => 'Pantalón formal', 'price' => 59.99, 'category_id' => 2],
            ['name' => 'Jeans Skinny', 'description' => 'Jeans ajustados elásticos', 'price' => 54.99, 'category_id' => 2],
            
            // Vestidos
            ['name' => 'Vestido de Noche', 'description' => 'Vestido largo elegante', 'price' => 89.99, 'category_id' => 3],
            ['name' => 'Vestido Casual', 'description' => 'Vestido corto para el día', 'price' => 39.99, 'category_id' => 3],
            ['name' => 'Vestido de Fiesta', 'description' => 'Vestido para ocasiones especiales', 'price' => 99.99, 'category_id' => 3],
            ['name' => 'Vestido Playero', 'description' => 'Vestido ligero de verano', 'price' => 34.99, 'category_id' => 3],
            ['name' => 'Vestido Coctel', 'description' => 'Vestido elegante corto', 'price' => 79.99, 'category_id' => 3],
        ];

        // Generar más productos usando los anteriores como base
        $baseProducts = $products;
        $allProducts = [];
        $categories = Category::all();

        // Agregar los productos base
        foreach ($baseProducts as $product) {
            $allProducts[] = $product;
        }

        // Generar variaciones de productos hasta llegar a 100
        while (count($allProducts) < 100) {
            $baseProduct = $baseProducts[array_rand($baseProducts)];
            $category = $categories->random();
            
            // Crear variación del producto
            $variation = [
                'name' => $this->generateVariationName($baseProduct['name']),
                'description' => $baseProduct['description'],
                'price' => $this->generateVariationPrice($baseProduct['price']),
                'category_id' => $category->id,
                'stock' => rand(0, 100),
                'status' => rand(0, 1),
            ];

            $allProducts[] = $variation;
        }

        // Obtener todas las características por tipo
        $characteristics = Characteristic::all()->groupBy('type');

        // Insertar todos los productos
        foreach ($allProducts as $productData) {
            $product = Product::create($productData);

            // Asignar características aleatorias
            // 1-2 tallas
            $this->attachRandomCharacteristics($product, $characteristics['Talla'], rand(1, 2));
            // 1-3 colores
            $this->attachRandomCharacteristics($product, $characteristics['Color'], rand(1, 3));
            // 1 material
            $this->attachRandomCharacteristics($product, $characteristics['Material'], 1);
            // 1-2 estilos
            $this->attachRandomCharacteristics($product, $characteristics['Estilo'], rand(1, 2));
        }
    }

    /**
     * Genera un nombre variante para un producto
     */
    private function generateVariationName(string $baseName): string
    {
        $colors = ['Negro', 'Blanco', 'Azul', 'Rojo', 'Verde', 'Amarillo', 'Gris', 'Rosa', 'Morado', 'Marrón'];
        $styles = ['Clásico', 'Moderno', 'Vintage', 'Premium', 'Sport', 'Casual', 'Elegante', 'Juvenil'];
        $materials = ['Algodón', 'Lino', 'Seda', 'Poliéster', 'Mezclilla', 'Lana'];

        $variation = rand(1, 3);
        $suffix = '';
        
        switch ($variation) {
            case 1:
                $suffix = $colors[array_rand($colors)];
                break;
            case 2:
                $suffix = $styles[array_rand($styles)];
                break;
            case 3:
                $suffix = $materials[array_rand($materials)];
                break;
            default:
                $suffix = '';
                break;
        }
        
        return $baseName . ' ' . $suffix;
    }

    /**
     * Genera un precio variante basado en el precio base
     */
    /**
     * Asigna características aleatorias a un producto
     */
    private function attachRandomCharacteristics($product, $characteristics, $count): void
    {
        if ($characteristics && $characteristics->count() > 0) {
            $selectedCharacteristics = $characteristics->random(min($count, $characteristics->count()));
            $product->characteristics()->attach($selectedCharacteristics->pluck('id')->toArray());
        }
    }

    private function generateVariationPrice(float $basePrice): float
    {
        $variation = rand(-20, 20) / 100; // Variación de -20% a +20%
        $newPrice = $basePrice * (1 + $variation);
        return round($newPrice, 2);
    }
}
