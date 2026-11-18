<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            // ELECTRÓNICA (categoria_id: 1)
            [
                'vendedor_id' => 1,
                'categoria_id' => 1,
                'marca_id' => 1,
                'nombre' => 'Audífonos Bluetooth Pro',
                'slug' => 'audifonos-bluetooth-pro',
                'descripcion' => 'Audífonos inalámbricos con sonido estéreo, conexión Bluetooth y batería de larga duración.',
                'estado' => 'activo',
            ],
            [
                'vendedor_id' => 1,
                'categoria_id' => 1,
                'marca_id' => 2,
                'nombre' => 'Smartwatch Deportivo',
                'slug' => 'smartwatch-deportivo',
                'descripcion' => 'Reloj inteligente con monitor de actividad física, contador de pasos y notificaciones.',
                'estado' => 'activo',
            ],
            [
                'vendedor_id' => 1,
                'categoria_id' => 1,
                'marca_id' => 1,
                'nombre' => 'Teclado Mecánico RGB',
                'slug' => 'teclado-mecanico-rgb',
                'descripcion' => 'Teclado mecánico con iluminación RGB, teclas resistentes y conexión USB.',
                'estado' => 'activo',
            ],

            // ROPA (categoria_id: 2)
            [
                'vendedor_id' => 1,
                'categoria_id' => 2,
                'marca_id' => 1,
                'nombre' => 'Polo Oversize Unisex',
                'slug' => 'polo-oversize-unisex',
                'descripcion' => 'Polo oversize de algodón con diseño urbano y corte relajado.',
                'estado' => 'activo',
            ],
            [
                'vendedor_id' => 1,
                'categoria_id' => 2,
                'marca_id' => 2,
                'nombre' => 'Jean Slim Fit Hombre',
                'slug' => 'jean-slim-fit-hombre',
                'descripcion' => 'Jean de mezclilla con corte slim fit, ideal para un estilo casual.',
                'estado' => 'activo',
            ],
            [
                'vendedor_id' => 1,
                'categoria_id' => 2,
                'marca_id' => 1,
                'nombre' => 'Casaca Denim Mujer',
                'slug' => 'casaca-denim-mujer',
                'descripcion' => 'Casaca de mezclilla con diseño moderno y acabado de calidad.',
                'estado' => 'activo',
            ],

            // HOGAR (categoria_id: 3)
            [
                'vendedor_id' => 1,
                'categoria_id' => 3,
                'marca_id' => 2,
                'nombre' => 'Lámpara LED de Escritorio',
                'slug' => 'lampara-led-escritorio',
                'descripcion' => 'Lámpara LED moderna con iluminación ajustable para espacios de estudio y trabajo.',
                'estado' => 'activo',
            ],
            [
                'vendedor_id' => 1,
                'categoria_id' => 3,
                'marca_id' => 1,
                'nombre' => 'Organizador Multiusos',
                'slug' => 'organizador-multiusos',
                'descripcion' => 'Organizador práctico para mantener ordenados diferentes espacios del hogar.',
                'estado' => 'activo',
            ],

            // DEPORTES (categoria_id: 4)
            [
                'vendedor_id' => 1,
                'categoria_id' => 4,
                'marca_id' => 1,
                'nombre' => 'Mancuernas Ajustables',
                'slug' => 'mancuernas-ajustables',
                'descripcion' => 'Juego de mancuernas ajustables para entrenamientos de fuerza en casa.',
                'estado' => 'activo',
            ],
            [
                'vendedor_id' => 1,
                'categoria_id' => 4,
                'marca_id' => 2,
                'nombre' => 'Pelota de Fútbol Profesional',
                'slug' => 'pelota-futbol-profesional',
                'descripcion' => 'Pelota de fútbol resistente con diseño deportivo para entrenamientos y partidos.',
                'estado' => 'activo',
            ],

            // JUGUETES (categoria_id: 5)
            [
                'vendedor_id' => 1,
                'categoria_id' => 5,
                'marca_id' => 1,
                'nombre' => 'Bloques de Construcción',
                'slug' => 'bloques-de-construccion',
                'descripcion' => 'Set de bloques de construcción para estimular la creatividad y aprendizaje infantil.',
                'estado' => 'activo',
            ],
            [
                'vendedor_id' => 1,
                'categoria_id' => 5,
                'marca_id' => 2,
                'nombre' => 'Auto de Juguete a Control Remoto',
                'slug' => 'auto-juguete-control-remoto',
                'descripcion' => 'Auto de juguete con control remoto, diseño deportivo y movimientos multidireccionales.',
                'estado' => 'activo',
            ],
            [
                    'nombre' => 'Polo Básico Hombre',
                    'slug' => 'polo-basico',
                    'descripcion' => 'Polo de algodón ideal para uso diario.',
                    'marca_id' => 1,
                    'categoria_id' => 2,
                    'vendedor_id' => 1,
                    'estado' => 'activo',
                ],
                [
                    'nombre' => 'Polo Oversize Hombre',
                    'slug' => 'polo-oversize',
                    'descripcion' => 'Polo oversize de algodón con corte moderno y cómodo.',
                    'marca_id' => 1,
                    'categoria_id' => 2,
                    'vendedor_id' => 1,
                    'estado' => 'activo',
                ],
                [
                    'nombre' => 'Jean Slim Fit Hombre',
                    'slug' => 'jean-slim-fit',
                    'descripcion' => 'Jean de corte slim fit ideal para combinar con diferentes estilos.',
                    'marca_id' => 1,
                    'categoria_id' => 2,
                    'vendedor_id' => 1,
                    'estado' => 'activo',
                ],
                [
                    'nombre' => 'Camisa Casual Hombre',
                    'slug' => 'camisa-casual',
                    'descripcion' => 'Camisa casual de algodón para ocasiones informales y formales.',
                    'marca_id' => 1,
                    'categoria_id' => 2,
                    'vendedor_id' => 1,
                    'estado' => 'activo',
                ],
                [
                    'nombre' => 'Blusa Casual Mujer',
                    'slug' => 'blusa-casual',
                    'descripcion' => 'Blusa femenina de diseño casual y tela suave.',
                    'marca_id' => 1,
                    'categoria_id' => 2,
                    'vendedor_id' => 1,
                    'estado' => 'activo',
                ],
                [
                    'nombre' => 'Casaca Ligera Unisex',
                    'slug' => 'casaca-ligera',
                    'descripcion' => 'Casaca ligera ideal para días frescos y uso diario.',
                    'marca_id' => 1,
                    'categoria_id' => 2,
                    'vendedor_id' => 1,
                    'estado' => 'activo',
                ],
        ];

        foreach ($productos as $producto) {
            Producto::updateOrInsert(
                ['slug' => $producto['slug']],
                array_merge($producto, [
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}