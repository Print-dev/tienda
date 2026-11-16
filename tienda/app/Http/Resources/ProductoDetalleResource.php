<?php

namespace App\Http\Resources;

use App\Support\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoDetalleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'nombre'              => $this->nombre,
            'slug'              => $this->slug,
            'descripcion' => $this->descripcion,
            'estado'       => $this->estado,        
            'marca'    => $this->whenLoaded('marca', fn () => $this->marca ? new MarcaResource($this->marca) : null),
            'categoria' => $this->whenLoaded('categoria', fn () => new CategoriaResource($this->categoria)),

            'productoImagenes' => $this->whenLoaded('productoImagenes', fn () => $this->productoImagenes->map(fn ($img) => [
                'id'         => $img->id,
                'url'        => Media::url($img->url),
                // 'alt'        => $img->alt,
                'producto_variante_id' => $img->producto_variante_id,
                //'is_primary' => $img->is_primary,
            ])->values()),


            // whenLoaded comprueba si la relacion specification esta cargada desde with en el controlador
            // whenLoaded es un metodo que permite cargar relaciones de manera condicional, en este caso si la relacion specifications esta cargada, se ejecuta la funcion anonima que mapea cada especificacion a un array con su nombre, slug, unidad y valor.
            // Especificaciones técnicas: [{name:"Capacidad", unit:"L", value:"420"}]
            // para hacer esto primero debemos asignarlo con with en el controlador, para que se cargue la relacion specifications, de lo contrario no se ejecutara la funcion anonima y no se mostrara nada.


            // whenLoaded() comprueba si una relación ya fue cargada previamente.
            // Si la relación specifications fue incluida en with() desde el controlador,
            // ejecuta la función anónima para transformar cada especificación en un array.
            // Si no fue cargada, no ejecuta la función y omite esa relación del JSON.
            'especificaciones' => 
                // debemos especificar con with en controlador para poder vincularlo desde resource
                $this->whenLoaded('especificaciones', 
                // recorrer y transformar la colección de atributos y y devolver una nueva colección formateada.
                fn () => $this->especificaciones->map(fn ($a) => [
                'nombre'  => $a->nombre,
                'slug'  => $a->slug,
                'unidad'  => $a->unidad,
                'valor' => $a->pivot->valor, // este campo valor viene de la tabla intermedia producto_atributo_valores, que es donde se almacena el valor del atributo para cada producto.
            ])->values()),

            // Selectores para la UI: [{name:"Talla", type:"text", values:[{id,value,color_hex}]}]
            'opciones'  => $this->whenLoaded('variantes', fn () => $this->buildOptions()),
            'variantes' => ProductoVarianteResource::collection($this->whenLoaded('variantes')),
        ];
    }

    private function buildOptions(): array
    {
        // obtenemo variantes ya que forma parte de la relacion entre product y variant, y luego obtenemos los 
        //optionValues de cada variant, eliminamos duplicados, ordenamos por position, agrupamos por el nombre 
        //de la opción, y finalmente mapeamos a un array con el nombre de la opción, el tipo de visualización y 
        //los valores asociados.

        //$this->variantes: obtiene las variantes relacionadas con el producto.
        //$variant->opcionValores: obtiene los valores de las opciones asociados a cada variante.
        //$value->opcion: accede a la opción a la que pertenece ese valor.
        //$value->opcion->nombre: obtiene el nombre de esa opción, por ejemplo, Color o Talla.
        
        return $this->variantes
            ->flatMap(fn ($variant) => $variant->opcionValores)
            ->unique('id')
            ->sortBy('posicion')
            ->groupBy(fn ($value) => $value->opcion->nombre) // el opcion viene de value y value viene de opcionValores
            // el proceso: Producto → variantes → opcionValores → opcion → nombre.
            ->map(fn ($values, $nombre) => [
                'nombre'   => $nombre,
                'tipo'   => $values->first()->opcion->tipo_display,
                'valores' => $values->map(fn ($v) => [
                    'id'        => $v->id,
                    'valor'     => $v->valor,
                    //'color_hex' => $v->color_hex,
                ])->values(),
            ])
            ->values()
            ->all();
    }
}
