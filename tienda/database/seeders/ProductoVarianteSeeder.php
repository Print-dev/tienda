<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\ProductoVariante;
use Illuminate\Database\Seeder;

class ProductoVarianteSeeder extends Seeder
{
    public function run(): void
    {
        $producto = Producto::query()
            ->where('slug', 'polo-basico')
            ->first();

        if (!$producto) {
            return;
        }

        $variantes = [
            [
                'sku' => 'POLO-ROJO-M',
                'precio_vigente' => 35.00,
                'precio_adquirido' => 20.00,
                'stock' => 20,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
                //'is_default' => 'activo',
            ],
            [
                'sku' => 'POLO-AZUL-M',
                'precio_vigente' => 35.00,
                'precio_adquirido' => 20.00,
                'stock' => 15,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
                //'is_default' => false,
            ],
            [
                'sku' => 'POLO-NEGRO-L',
                'precio_vigente' => 40.00,
                'precio_adquirido' => 30.00,
                'stock' => 10,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
                //'is_default' => false,
            ],
        ];

        foreach ($variantes as $variante) {

            ProductoVariante::updateOrInsert(
                [
                    'sku' => $variante['sku'],
                ],
                array_merge($variante, [
                    'producto_id' => $producto->id,
                ])
            );
        }
    }
}