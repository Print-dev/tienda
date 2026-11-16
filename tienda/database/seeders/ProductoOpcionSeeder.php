
<?php

namespace Database\Seeders;

use App\Models\Opcion;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoOpcionSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar el producto
        $producto = Producto::query()
            ->where('slug', 'polo-basico')
            ->first();

        if (!$producto) {
            return;
        }

        // Opciones y valores que tendrá el producto
        $configuracion = [
            'color' => ['Rojo', 'Azul', 'Negro'],
            'talla' => ['S', 'M', 'L'],
        ];

        foreach ($configuracion as $slug => $valores) {

            // Buscar la opción
            $opcion = Opcion::query()
                ->where('slug', $slug)
                ->first();

            if (!$opcion) {
                continue;
            }

            // Relacionar producto con opción
            ProductoOpcio updateOrInsert(
                [
                    'producto_id' => $producto->id,
                    'opcion_id' => $opcion->id,
                ]
            );

            // Obtener el registro de producto_opciones
            $productoOpcion = DB::table('producto_opciones')
                ->where('producto_id', $producto->id)
                ->where('opcion_id', $opcion->id)
                ->first();

            // Relacionar los valores seleccionados
            foreach ($valores as $valor) {

                $opcionValor = DB::table('opcion_valores')
                    ->where('opcion_id', $opcion->id)
                    ->where('valor', $valor)
                    ->first();

                if (!$opcionValor) {
                    continue;
                }

                DB::table('producto_opcion_valores')->updateOrInsert(
                    [
                        'producto_opcion_id' => $productoOpcion->id,
                        'opcion_valor_id' => $opcionValor->id,
                    ],
                    []
                );
            }
        }
    }
}
