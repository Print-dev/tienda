<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(Vendedor::class);
    }

    //devuelve Las 6 variantes y se usa en La página de detalle del producto (show)
    public function variantes(): HasMany
    {
        return $this->hasMany(ProductoVariante::class);
    }

    public function productoImagenes(): HasMany
    {
        return $this->hasMany(ProductoImagen::class);
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    /* public function productoAtributoValores(): HasMany
    {
        return $this->hasMany(ProductoAtributoValor::class);
    } */

    public function scopeActivo($query)
    {
        return $query->where('estado', 'activo');
    }

    //la variante que representa al producto
    public function defaultVariant(): HasOne
    {
        //de las variantes de este producto, dame una sola, la marcada con is_default = true
        return $this->hasOne(ProductoVariante::class)->where('is_default', true);
    }

    public function especificaciones(): BelongsToMany
    {
        return $this->belongsToMany(Atributo::class, 'producto_atributo_valores', 'producto_id', 'atributo_id')
            ->withPivot('valor'); // withPivot para incluir el valor del atributo en la relación
    }
}
