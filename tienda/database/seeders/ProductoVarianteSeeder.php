<?php

namespace Database\Seeders;

use App\Models\Opcion;
use App\Models\OpcionValor;
use App\Models\Producto;
use App\Models\ProductoVariante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ProductoVarianteSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguarded(function () {

            // 1. Crear o buscar las opciones generales

            $color = Opcion::firstOrCreate(
                ['slug' => 'color'],
                [
                    'nombre' => 'Color',
                    'tipo_display' => 'color',
                ]
            );

            $talla = Opcion::firstOrCreate(
                ['slug' => 'talla'],
                [
                    'nombre' => 'Talla',
                    'tipo_display' => 'text',
                ]
            );

            // 2. Definir las variantes de cada producto

            $productos = [

                'polo-basico' => [
                    [
                        'sku' => 'POLO-ROJO-M',
                        'precio_vigente' => 35,
                        'precio_anterior' => null,
                        'precio_adquirido' => 20,
                        'stock' => 20,
                        'is_default' => true,
                        'color' => ['Rojo', '#D32F2F'],
                        'talla' => 'M',
                    ],
                    [
                        'sku' => 'POLO-AZUL-M',
                        'precio_vigente' => 35,
                        'precio_anterior' => null,
                        'precio_adquirido' => 20,
                        'stock' => 15,
                        'is_default' => false,
                        'color' => ['Azul', '#1565C0'],
                        'talla' => 'M',
                    ],
                    [
                        'sku' => 'POLO-NEGRO-L',
                        'precio_vigente' => 40,
                        'precio_anterior' => null,
                        'precio_adquirido' => 30,
                        'stock' => 10,
                        'is_default' => false,
                        'color' => ['Negro', '#000000'],
                        'talla' => 'L',
                    ],
                ],

                'polo-oversize' => [
                    [
                        'sku' => 'OVER-NEGRO-L',
                        'precio_vigente' => 55,
                        'precio_anterior' => 65,
                        'precio_adquirido' => 30,
                        'stock' => 12,
                        'is_default' => true,
                        'color' => ['Negro', '#000000'],
                        'talla' => 'L',
                    ],
                    [
                        'sku' => 'OVER-BLANCO-XL',
                        'precio_vigente' => 55,
                        'precio_anterior' => 65,
                        'precio_adquirido' => 30,
                        'stock' => 8,
                        'is_default' => false,
                        'color' => ['Blanco', '#FFFFFF'],
                        'talla' => 'XL',
                    ],
                    [
                        'sku' => 'OVER-BEIGE-L',
                        'precio_vigente' => 55,
                        'precio_anterior' => null,
                        'precio_adquirido' => 30,
                        'stock' => 10,
                        'is_default' => false,
                        'color' => ['Beige', '#D6C3A5'],
                        'talla' => 'L',
                    ],
                ],

                'jean-slim-fit' => [
                    [
                        'sku' => 'JEAN-AZUL-30',
                        'precio_vigente' => 89,
                        'precio_anterior' => 109,
                        'precio_adquirido' => 55,
                        'stock' => 10,
                        'is_default' => true,
                        'color' => ['Azul', '#1565C0'],
                        'talla' => '30',
                    ],
                    [
                        'sku' => 'JEAN-NEGRO-32',
                        'precio_vigente' => 89,
                        'precio_anterior' => 109,
                        'precio_adquirido' => 55,
                        'stock' => 8,
                        'is_default' => false,
                        'color' => ['Negro', '#000000'],
                        'talla' => '32',
                    ],
                    [
                        'sku' => 'JEAN-CELESTE-34',
                        'precio_vigente' => 95,
                        'precio_anterior' => null,
                        'precio_adquirido' => 60,
                        'stock' => 6,
                        'is_default' => false,
                        'color' => ['Celeste', '#87CEEB'],
                        'talla' => '34',
                    ],
                ],

                'camisa-casual' => [
                    [
                        'sku' => 'CAMISA-BLANCO-M',
                        'precio_vigente' => 75,
                        'precio_anterior' => null,
                        'precio_adquirido' => 40,
                        'stock' => 10,
                        'is_default' => true,
                        'color' => ['Blanco', '#FFFFFF'],
                        'talla' => 'M',
                    ],
                    [
                        'sku' => 'CAMISA-CELESTE-L',
                        'precio_vigente' => 75,
                        'precio_anterior' => null,
                        'precio_adquirido' => 40,
                        'stock' => 8,
                        'is_default' => false,
                        'color' => ['Celeste', '#87CEEB'],
                        'talla' => 'L',
                    ],
                    [
                        'sku' => 'CAMISA-NEGRO-M',
                        'precio_vigente' => 80,
                        'precio_anterior' => null,
                        'precio_adquirido' => 45,
                        'stock' => 7,
                        'is_default' => false,
                        'color' => ['Negro', '#000000'],
                        'talla' => 'M',
                    ],
                ],

                'blusa-casual' => [
                    [
                        'sku' => 'BLUSA-BLANCO-S',
                        'precio_vigente' => 59,
                        'precio_anterior' => null,
                        'precio_adquirido' => 30,
                        'stock' => 10,
                        'is_default' => true,
                        'color' => ['Blanco', '#FFFFFF'],
                        'talla' => 'S',
                    ],
                    [
                        'sku' => 'BLUSA-ROSA-M',
                        'precio_vigente' => 59,
                        'precio_anterior' => null,
                        'precio_adquirido' => 30,
                        'stock' => 12,
                        'is_default' => false,
                        'color' => ['Rosa', '#E8A0BF'],
                        'talla' => 'M',
                    ],
                    [
                        'sku' => 'BLUSA-BEIGE-L',
                        'precio_vigente' => 65,
                        'precio_anterior' => null,
                        'precio_adquirido' => 35,
                        'stock' => 8,
                        'is_default' => false,
                        'color' => ['Beige', '#D6C3A5'],
                        'talla' => 'L',
                    ],
                ],

                'casaca-ligera' => [
                    [
                        'sku' => 'CASACA-NEGRO-M',
                        'precio_vigente' => 129,
                        'precio_anterior' => 149,
                        'precio_adquirido' => 75,
                        'stock' => 8,
                        'is_default' => true,
                        'color' => ['Negro', '#000000'],
                        'talla' => 'M',
                    ],
                    [
                        'sku' => 'CASACA-VERDE-L',
                        'precio_vigente' => 129,
                        'precio_anterior' => 149,
                        'precio_adquirido' => 75,
                        'stock' => 6,
                        'is_default' => false,
                        'color' => ['Verde', '#388E3C'],
                        'talla' => 'L',
                    ],
                    [
                        'sku' => 'CASACA-BEIGE-XL',
                        'precio_vigente' => 139,
                        'precio_anterior' => null,
                        'precio_adquirido' => 80,
                        'stock' => 5,
                        'is_default' => false,
                        'color' => ['Beige', '#D6C3A5'],
                        'talla' => 'XL',
                    ],
                ],
            ];

            // 3. Recorrer los productos y crear sus variantes

            foreach ($productos as $slug => $variantes) {

                $producto = Producto::where('slug', $slug)
                    ->firstOrFail();

                foreach ($variantes as $index => $item) {

                    // Crear o actualizar la variante

                    $variant = ProductoVariante::updateOrCreate(
                        ['sku' => $item['sku']],
                        [
                            'producto_id' => $producto->id,
                            'precio_vigente' => $item['precio_vigente'],
                            'precio_anterior' => $item['precio_anterior'],
                            'precio_adquirido' => $item['precio_adquirido'],
                            'stock' => $item['stock'],
                            'is_default' => $item['is_default'],
                            'estado' => 'activo',
                        ]
                    );

                    // 4. Buscar o crear el valor del color

                    $colorValor = OpcionValor::firstOrCreate(
                        [
                            'opcion_id' => $color->id,
                            'valor' => $item['color'][0],
                        ],
                        [
                            'color_hex' => $item['color'][1],
                            'posicion' => 0,
                        ]
                    );

                    // 5. Buscar o crear el valor de la talla

                    $tallaValor = OpcionValor::firstOrCreate(
                        [
                            'opcion_id' => $talla->id,
                            'valor' => $item['talla'],
                        ],
                        [
                            'color_hex' => null,
                            'posicion' => 0,
                        ]
                    );

                    // 6. Asociar color y talla a la variante

                    $variant->opcionValores()
                        ->syncWithoutDetaching([
                            $colorValor->id,
                            $tallaValor->id,
                        ]);
                }
            }
        });
    }
}