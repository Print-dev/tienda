<?php

namespace Database\Seeders;

use App\Models\Atributo;
use App\Models\Producto;
use App\Models\ProductoAtributoValor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoAtributoValorSeeder extends Seeder
{
    public function run(): void
    {
        $producto = Producto::query()
            ->where('slug', 'polo-basico')
            ->first();

        if (!$producto) {
            return;
        }

        $especificaciones = [
            [
                'attribute_slug' => 'material',
                'value' => 'Algodón',
            ],
            [
                'attribute_slug' => 'composicion',
                'value' => '100',
            ],
        ];

        foreach ($especificaciones as $especificacion) {

            $atributo = Atributo::query()
                ->where('slug', $especificacion['attribute_slug'])
                ->first();

            if (!$atributo) {
                continue;
            }

            ProductoAtributoValor::updateOrInsert(
                [
                    'producto_id' => $producto->id,
                    'atributo_id' => $atributo->id,
                ],
                [
                    'valor' => $especificacion['value'],
                ]
            );
        }
    }
}