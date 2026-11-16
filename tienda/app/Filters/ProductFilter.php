<?php 

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder; // 
use Illuminate\Http\Request;

class ProductFilter
{
    // esta clase se encarga de aplicar filtros a la consulta de productos según los parámetros de la solicitud HTTP.
     public function __construct(private Request $request)
    {
    }

    // aplicar filtros a la consulta
    // $query es la consulta de Eloquent que se está filtrandol 

    public function apply(Builder $query): Builder
    {
        //$r = $this->request; // se obtiene la solicitud HTTP actual (osea viene del constructor) y se asigna a la variable $r para su uso posterior en el método. Esto permite acceder a los parámetros de la solicitud, como los filtros de búsqueda, de manera más conveniente dentro del método apply.
        $r = $this->request;

        //El método filled() comprueba si un parámetro existe y tiene un valor no vacío.
        // aplica funcion anonima (closure)
        // $q representa la misma consulta que estás construyendo con $query.
        // use ($R) permite que la función anónima acceda a la variable $r del ámbito exterior, que contiene la solicitud HTTP.
        // el $query de la function anónima es la misma consulta que estás construyendo con $query, y puedes modificarla dentro de la función para aplicar filtros según los parámetros de la solicitud.
        // Laravel internamente le pasa el Builder actual como argumento a la función anónima.
        $query->when($r->filled('q'), function ($query) use ($r) {
            $query->where('nombre', 'like', '%' . $r->input('q') . '%');
        });

        //return $this->sort($query);
        return $query;
    }

    /* private function sort(Builder $query): Builder
    {
        return match ($this->request->input('sort', 'relevance')) {
            'newest'     => $query->orderByDesc('created_at'),
            'price_asc'  => $query->orderBy('price_min')->orderBy('id'),
            'price_desc' => $query->orderByDesc('price_min')->orderBy('id'),
            'rating'     => $query->orderByDesc('rating_avg')->orderByDesc('rating_count'),
            'name'       => $query->orderBy('name'),
            default      => $query->orderByDesc('is_featured')->orderByDesc('created_at'),
        };
    } */

}
