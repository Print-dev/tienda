<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductoAtributoValor extends Model
{
        protected $table = 'producto_atributo_valores';

    public function atributo(): BelongsTo
    {
        return $this->belongsTo(Atributo::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
