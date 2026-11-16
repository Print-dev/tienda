<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Opcion extends Model
{
    /** @use HasFactory<\Database\Factories\OpcionFactory> */
    use HasFactory;
        protected $table = 'opciones';


    public function opcionValores(): HasMany
    {
        return $this->hasMany(OpcionValor::class);
    }
}
