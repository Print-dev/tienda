<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OpcionValor extends Model
{
    /** @use HasFactory<\Database\Factories\OpcionValorFactory> */
    use HasFactory;
    protected $table = 'opcion_valores';
    public $timestamps = false;

    /* public function varianteOpcionValores(): HasMany
    {
        return $this->hasMany(VarianteOpcionValor::class);
    } */
   public function variants(): BelongsToMany
   {
        return $this->belongsToMany(ProductoVariante::class, 'variante_opcion_valores', 'opcion_valor_id', 'producto_variante_id');
   }

    public function opcion(): BelongsTo
    {
        return $this->belongsTo(Opcion::class);
    }
}
