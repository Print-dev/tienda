<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VarianteOpcionValor extends Model
{
    protected $table = 'variante_opcion_valores';
    public function productoVariante(): BelongsTo
    {
        return $this->belongsTo(ProductoVariante::class);
    }

    public function opcionValor(): BelongsTo
    {
        return $this->belongsTo(OpcionValor::class);
    }
}
