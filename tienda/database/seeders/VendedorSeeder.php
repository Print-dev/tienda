<?php

namespace Database\Seeders;

use App\Models\Vendedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendedor::updateOrInsert(
            ['user_id' => 1,
            'nombre_empresa' => 'TechWorld',
            'slug' => 'techworld',
            ]
        );
    }
}
