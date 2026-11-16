<?php

namespace Database\Seeders;

use App\Models\Atributo;
use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaAtributoSeeder extends Seeder
{
    public function run(): void
    {
        $relaciones = [
            'electronica' => [
                'ram',
                'almacenamiento',
                'pantalla',
            ],
            'ropa' => [
                'material',
                'composicion',
            ],
        ];

        foreach ($relaciones as $categoriaSlug => $atributos) {

            $categoria = Categoria::where('slug', $categoriaSlug)->first();

            if (!$categoria) {
                continue;
            }

            foreach ($atributos as $atributoSlug) {

                $atributo = Atributo::where('slug', $atributoSlug)->first();

                if (!$atributo) {
                    continue;
                }

                Categoria::find($categoria->id)->atributos()->syncWithoutDetaching($atributo->id);
            }
        }
    }
}