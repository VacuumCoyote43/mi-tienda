<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $characteristics = [
            // Tallas
            ['name' => 'Talla XS', 'type' => 'Talla', 'value' => 'XS'],
            ['name' => 'Talla S', 'type' => 'Talla', 'value' => 'S'],
            ['name' => 'Talla M', 'type' => 'Talla', 'value' => 'M'],
            ['name' => 'Talla L', 'type' => 'Talla', 'value' => 'L'],
            ['name' => 'Talla XL', 'type' => 'Talla', 'value' => 'XL'],
            ['name' => 'Talla XXL', 'type' => 'Talla', 'value' => 'XXL'],

            // Colores
            ['name' => 'Color Negro', 'type' => 'Color', 'value' => '#000000'],
            ['name' => 'Color Blanco', 'type' => 'Color', 'value' => '#FFFFFF'],
            ['name' => 'Color Azul', 'type' => 'Color', 'value' => '#0000FF'],
            ['name' => 'Color Rojo', 'type' => 'Color', 'value' => '#FF0000'],
            ['name' => 'Color Verde', 'type' => 'Color', 'value' => '#00FF00'],
            ['name' => 'Color Amarillo', 'type' => 'Color', 'value' => '#FFFF00'],

            // Materiales
            ['name' => 'Algodón', 'type' => 'Material', 'value' => '100% Algodón'],
            ['name' => 'Poliéster', 'type' => 'Material', 'value' => '100% Poliéster'],
            ['name' => 'Mezcla', 'type' => 'Material', 'value' => '60% Algodón 40% Poliéster'],
            ['name' => 'Lana', 'type' => 'Material', 'value' => '100% Lana'],
            ['name' => 'Lino', 'type' => 'Material', 'value' => '100% Lino'],
            ['name' => 'Seda', 'type' => 'Material', 'value' => '100% Seda'],

            // Estilos
            ['name' => 'Casual', 'type' => 'Estilo', 'value' => 'Casual'],
            ['name' => 'Formal', 'type' => 'Estilo', 'value' => 'Formal'],
            ['name' => 'Deportivo', 'type' => 'Estilo', 'value' => 'Deportivo'],
            ['name' => 'Elegante', 'type' => 'Estilo', 'value' => 'Elegante'],
            ['name' => 'Vintage', 'type' => 'Estilo', 'value' => 'Vintage'],
            ['name' => 'Moderno', 'type' => 'Estilo', 'value' => 'Moderno'],
        ];

        foreach ($characteristics as $characteristic) {
            Characteristic::create($characteristic);
        }
    }
}
