<?php

namespace App\Http\Controllers\Api;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoRequest;
use App\Http\Resources\ProductoDetalleResource;
use App\Http\Resources\ProductoResource;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //ProductIndexRequest: comprueba que los filtros enviados sean válidos.
    // - ProductFilter: utiliza esos filtros para construir la consulta a MySQL.
    public function index(ProductoRequest $request, ProductFilter $filter)
    {
        //Quiero comenzar a construir una consulta para obtener productos, pero todavía no quiero ejecutarla.
        // Producto::query();//inicia la consulta.
        $filteredQuery = $filter->apply(Producto::query())->paginate($request->integer('per_page', 10))->withQueryString();;//aplica los filtros a la consulta de productos según los parámetros de la solicitud HTTP.
        return ProductoResource::collection($filteredQuery);//devuelve una colección de recursos de productos filtrados y paginados.
        //withQueryString() en Laravel sirve para conservar los parámetros de la URL cuando navegas entre las páginas de una paginación.
    }

    /**
     * Store a newly created resource in storage.
     */
    /* public function store()
    {
        //
    } */

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $producto = Producto::activo()
            ->where('slug', $slug)
            // cargar anticipadamente las relaciones variantes, varianteOpcionValores y opcion para evitar consultas adicionales a la base de datos cuando se acceda a estas relaciones más adelante.
            //eager loading anidado
            // al usar with evitamos el problema de N+1 queries, que ocurre cuando se realizan múltiples consultas a la base de datos para obtener relaciones de un modelo.
            ->with([
                'marca',
                //eager loading anidado
                'categoria.categoriaPadre.categoriaPadre',
                'productoImagenes',
                'especificaciones',
                'variantes' => fn ($q) => $q->where('estado', 'activo')->orderBy('precio_vigente'),
                'variantes.opcionValores.opcion',
            ])
            ->firstOrFail();
        return new ProductoDetalleResource($producto);
    }

    /** GET /api/v1/products/{slug}/related — misma categoría, sin incluir el actual. */
    public function related(string $slug)
    {
        $product = Producto::active()->where('slug', $slug)->firstOrFail();

        $related = ProductListQuery::base()
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->orderByDesc('rating_avg')
            ->limit(8)
            ->get();

        return ProductListResource::collection($related);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
