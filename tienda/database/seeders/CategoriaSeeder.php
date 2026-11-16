<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Electrónica','slug' => 'electronica'],
            ['nombre' => 'Ropa','slug' => 'ropa'],
            ['nombre' => 'Hogar','slug' => 'hogar'],
            ['nombre' => 'Deportes','slug' => 'deportes'],
            ['nombre' => 'Juguetes','slug' => 'juguetes'],
        ];
        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
