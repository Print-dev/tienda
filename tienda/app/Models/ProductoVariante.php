<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductoVariante extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoVarianteFactory> */
    use HasFactory;

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function productoImagen(): HasMany
    {
        return $this->hasMany(ProductoImagen::class);
    }

    public function inventarioMovimientos(): HasMany
    {
        return $this->hasMany(InventarioMovimiento::class);
    }

    /* public function varianteOpcionValores(): HasMany
    {
        return $this->hasMany(VarianteOpcionValor::class);
    } */

    public function opcionValores(): BelongsToMany
    {
        return $this->belongsToMany(OpcionValor::class, 'variante_opcion_valores', 'producto_variante_id', 'opcion_valor_id');
    }
}
