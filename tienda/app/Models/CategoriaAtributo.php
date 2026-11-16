<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoriaAtributo extends Model
{
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function atributo(): BelongsTo
    {
        return $this->belongsTo(Atributo::class);
    }
}
