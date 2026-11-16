<?php

namespace Database\Seeders;

use App\Models\Opcion;
use App\Models\OpcionValor;
use Illuminate\Database\Seeder; 

class OpcionValorSeeder extends Seeder
{
    public function run(): void
    {
        $valores = [
            // Colores
            [
                'opcion_id' => 1,
                'value' => 'Rojo',
                'color_hex' => '#FF0000',
                'posicion' => 1,
            ],
            [
                'opcion_id' => 1,
                'value' => 'Azul',
                'color_hex' => '#0000FF',
                'posicion' => 2,
            ],
            [
                'opcion_id' => 1,
                'value' => 'Negro',
                'color_hex' => '#000000',
                'posicion' => 3,
            ],

            // Tallas
            [
                'opcion_id' => 2,
                'value' => 'S',
                'color_hex' => null,
                'posicion' => 1,
            ],
            [
                'opcion_id' => 2,
                'value' => 'M',
                'color_hex' => null,
                'posicion' => 2,
            ],
            [
                'opcion_id' => 2,
                'value' => 'L',
                'color_hex' => null,
                'posicion' => 3,
            ],
        ];

        foreach ($valores as $valor) {

            $option = Opcion::where('id', $valor['opcion_id'])->first();

            if (!$option) {
                continue;
            }

            OpcionValor::updateOrInsert(
                [
                    'opcion_id' => $option->id,
                    'valor' => $valor['value'],
                ],
                [
                    'color_hex' => $valor['color_hex'],
                    'posicion' => $valor['posicion'],
                ]
            );
        }
    }
}