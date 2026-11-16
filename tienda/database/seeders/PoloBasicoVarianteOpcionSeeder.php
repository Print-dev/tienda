<?php

namespace Database\Seeders;

use App\Models\Opcion;
use App\Models\OpcionValor;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class PoloBasicoVarianteOpcionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buscar el producto
        $product = Producto::where('slug', 'polo-basico')
            ->firstOrFail();

        // 2. Buscar o crear las opciones
        $color = Opcion::firstOrCreate(
            ['nombre' => 'Color'],
            ['tipo_display' => 'color']
        );

        $talla = Opcion::firstOrCreate(
            ['nombre' => 'Talla'],
            ['tipo_display' => 'text']
        );

        // 3. Definir los valores de cada variante
        $variants = [
            'POLO-ROJO-M' => [
                [$color, 'Rojo', '#D32F2F'],
                [$talla, 'M', null],
            ],

            'POLO-AZUL-M' => [
                [$color, 'Azul', '#1565C0'],
                [$talla, 'M', null],
            ],

            'POLO-NEGRO-L' => [
                [$color, 'Negro', '#000000'],
                [$talla, 'L', null],
            ],
        ];

        // 4. Recorrer las variantes del producto
        foreach ($variants as $sku => $values) {

            $variant = $product->variantes()
                ->where('sku', $sku)
                ->firstOrFail();

            foreach ($values as [$option, $value, $colorHex]) {

                // Buscar o crear el valor de la opción
                $optionValue = OpcionValor::firstOrCreate(
                    [
                        'opcion_id' => $option->id,
                        'valor' => $value,
                    ],
                    [
                        'color_hex' => $colorHex,
                    ]
                );

                // Asociar el valor con la variante
                $variant->opcionValores()
                    ->syncWithoutDetaching([$optionValue->id]);
            }
        }
    }
}
