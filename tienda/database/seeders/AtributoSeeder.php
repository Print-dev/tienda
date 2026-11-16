<?php

namespace Database\Seeders;

use App\Models\Atributo;
use Illuminate\Database\Seeder;

class AtributoSeeder extends Seeder
{
    public function run(): void
    {
        $atributos = [
            [
                'nombre' => 'RAM',
                'slug' => 'ram',
                'unidad' => 'GB',
                'is_filterable' => true, //ME QUEDE ACAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA REVISAR SI LA TABLA TRAE ESTA COLUMNA
            ],
            [
                'nombre' => 'Almacenamiento',
                'slug' => 'almacenamiento',
                'unidad' => 'GB',
                'is_filterable' => true,
            ],
            [
                'nombre' => 'Pantalla',
                'slug' => 'pantalla',
                'unidad' => 'pulgadas',
                'is_filterable' => true,
            ],
            [
                'nombre' => 'Material',
                'slug' => 'material',
                'unidad' => null,
                'is_filterable' => true,
            ],
            [
                'nombre' => 'Composición',
                'slug' => 'composicion',
                'unidad' => '%',
                'is_filterable' => false,
            ],
        ];

        foreach ($atributos as $atributo) {
            Atributo::updateOrInsert(
                ['slug' => $atributo['slug']],
                $atributo
            );
        }
    }
}