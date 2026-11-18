<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            [
                'nombre' => 'Platanitos',
                'slug' => 'platanitos',
            ],
            [
                'nombre' => 'Samsung',
                'slug' => 'samsung',
            ],
            [
                    'nombre' => 'Platanitos',
                    'slug' => 'platanitos',
                ],
                [
                    'nombre' => 'Adidas',
                    'slug' => 'adidas',
                ],
                [
                    'nombre' => 'Nike',
                    'slug' => 'nike',
                ],
                [
                    'nombre' => 'Puma',
                    'slug' => 'puma',
                ],
                [
                    'nombre' => 'Zara',
                    'slug' => 'zara',
                ],
                [
                    'nombre' => 'H&M',
                    'slug' => 'hm',
                ],
        ];

        foreach ($marcas as $marca) {
            Marca::updateOrInsert(
                ['slug' => $marca['slug']],
                array_merge($marca, [
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}
