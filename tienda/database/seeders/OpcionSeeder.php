<?php

namespace Database\Seeders;

use App\Models\Opcion;
use Illuminate\Database\Seeder;


class OpcionSeeder extends Seeder
{
    public function run(): void
    {
        $opciones = [
            [
                'nombre' => 'Color',
                'slug' => 'color',
                'tipo_display' => 'color',
            ],
            [
                'nombre' => 'Talla',
                'slug' => 'talla',
                'tipo_display' => 'text',
            ],
        ];

        foreach ($opciones as $opcion) {
            Opcion::updateOrInsert(
                ['slug' => $opcion['slug']],
                $opcion
            );
        }
    }
}