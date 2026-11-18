<?php

namespace Database\Seeders;

use App\Models\Atributo;
use App\Models\Producto;
use App\Models\ProductoAtributoValor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ProductoAtributoValorSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguarded(function () {

            // 1. Crear o buscar los atributos generales

            $atributos = [
                'material' => [
                    'nombre' => 'Material',
                    'unidad' => null,
                ],
                'composicion' => [
                    'nombre' => 'Composición',
                    'unidad' => '%',
                ],
                'genero' => [
                    'nombre' => 'Género',
                    'unidad' => null,
                ],
                'estilo' => [
                    'nombre' => 'Estilo',
                    'unidad' => null,
                ],
            ];

            $atributosEncontrados = [];

            foreach ($atributos as $slug => $item) {

                $atributosEncontrados[$slug] = Atributo::firstOrCreate(
                    ['slug' => $slug],
                    [
                        'nombre' => $item['nombre'],
                        'unidad' => $item['unidad'],
                        'is_filterable' => true,
                    ]
                );
            }

            // 2. Definir las especificaciones de cada producto

            $productos = [

                'polo-basico' => [
                    'material' => 'Algodón',
                    'composicion' => '100',
                    'genero' => 'Hombre',
                    'estilo' => 'Casual',
                ],

                'polo-oversize' => [
                    'material' => 'Algodón',
                    'composicion' => '100',
                    'genero' => 'Hombre',
                    'estilo' => 'Urbano',
                ],

                'jean-slim-fit' => [
                    'material' => 'Denim',
                    'composicion' => '98',
                    'genero' => 'Hombre',
                    'estilo' => 'Casual',
                ],

                'camisa-casual' => [
                    'material' => 'Algodón',
                    'composicion' => '100',
                    'genero' => 'Hombre',
                    'estilo' => 'Casual',
                ],

                'blusa-casual' => [
                    'material' => 'Poliéster',
                    'composicion' => '100',
                    'genero' => 'Mujer',
                    'estilo' => 'Casual',
                ],

                'casaca-ligera' => [
                    'material' => 'Poliéster',
                    'composicion' => '100',
                    'genero' => 'Unisex',
                    'estilo' => 'Deportivo',
                ],
            ];

            // 3. Asociar las especificaciones a cada producto

            foreach ($productos as $slug => $especificaciones) {

                $producto = Producto::where('slug', $slug)
                    ->firstOrFail();

                foreach ($especificaciones as $atributoSlug => $valor) {

                    $atributo = $atributosEncontrados[$atributoSlug];

                    ProductoAtributoValor::updateOrCreate(
                        [
                            'producto_id' => $producto->id,
                            'atributo_id' => $atributo->id,
                        ],
                        [
                            'valor' => $valor,
                        ]
                    );
                }
            }
        });
    }
}