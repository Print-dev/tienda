<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }

    /* public function categoriaAtributos(): HasMany
    {
        return $this->hasMany(CategoriaAtributo::class);
    }    */

    public function atributos(): BelongsToMany
    {
        return $this->belongsToMany(Atributo::class, 'categoria_atributos', 'categoria_id', 'atributo_id');
    }

    //Una categoría superior
    public function categoriaPadre(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    //Una colección de categorías hijas
    public function subcategorias(): HasMany
    {
        return $this->hasMany(Categoria::class, 'categoria_id');
    }
}
