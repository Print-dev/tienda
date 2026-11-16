<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Atributo extends Model
{
    protected $guarded = []; // guarded es para proteger los campos que no queremos que se asignen masivamente, en este caso no hay ninguno
    //public $timestamps = false; // timestamps es para desactivar los campos created_at y updated_at, en este caso no los necesitamos
    /* public function productoAtributoValores(): HasMany
    {
        return $this->hasMany(ProductoAtributoValor::class);
    } */

    /* public function categoriaAtributos(): HasMany
    {
        return $this->hasMany(CategoriaAtributo::class);
    } */

    // esto practicamente dice atributos esta en muchas categorias y categorias tiene muchos atributos, es una relacion de muchos a muchos
   public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class, 'categoria_atributos', 'atributo_id', 'categoria_id');
    }
    
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'producto_atributo_valores', 'atributo_id', 'producto_id')
            ->withPivot('valor'); // withPivot para incluir el valor del atributo en la relación
            // usamos el withPivot en la relacion inversa para poder acceder al valor del atributo desde el modelo Producto
    }

    //Cuando el usuario visita tu tienda, puedes utilizar este campo para decidir qué especificaciones mostrar como filtros en el catálogo.
    //Por ejemplo, permitir filtrar celulares por RAM, pero no necesariamente por procesador.
    // // Convierte automáticamente is_filterable a un booleano (true o false),
    // permitiendo identificar si un atributo puede utilizarse como filtro
    // en el catálogo de productos.
    protected function casts(): array
    {
        //Esto indica a Laravel que debe convertir automáticamente el campo is_filterable a un valor booleano de PHP.
        // de esta manera obtendremos el id de la categoria y el id del atributo que estamos consultando, y podremos filtrar los productos por ese atributo en esa categoria. osea obtener todos los productos que tengan un atributo especifico en una categoria especifica.
        return [
            'is_filterable' => 'boolean', // 
        ];
    }
}
