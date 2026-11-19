<?php

namespace App\Queries;

use App\Models\Product;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Builder;

class ProductListQuery
{
    /**
     * Consulta base para tarjetas de producto (listados, home, relacionados).
     * Trae precio mínimo/máximo y stock total ya calculados para evitar N+1.
     */
    //Builder es el tipo de objeto que representa una consulta que se está armando y aún no se ejecutó. Lo importamos porque el método declara que devuelve uno.
    public static function base(): Builder
    //indica que devuelve una consulta pendiente. Por eso, quien lo llama puede seguir añadiendo condiciones
    {
        $active = fn ($q) => $q->where('is_active', true);
    
        return Producto::query()
            ->active()
            ->with([
                'marca:id,nombre,slug',
                'defaultVariant',
                'images' => fn ($q) => $q->where('is_primary', true),
            ])
            ->withCount(['variants as variants_count' => $active])
            ->withMin(['variants as price_min' => $active], 'price')
            ->withMax(['variants as price_max' => $active], 'price')
            ->withSum(['variants as stock_total' => $active], 'stock');
    }
}
