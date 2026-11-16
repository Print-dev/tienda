<?php
namespace Database\Seeders;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder {
public function run(): void
{
    Producto::updateOrInsert(
        ['slug' => 'polo-basico'],
        [
            'nombre' => 'Polo Básico Hombre',
            'slug' => 'polo-basico',            
            'descripcion' => 'Polo de algodón ideal para uso diario.',
            'vendedor_id' => 1,
            'marca_id' => 1,
            'categoria_id' => 2,
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
}}