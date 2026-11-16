<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendedor extends Model
{
    /** @use HasFactory<\Database\Factories\VendedorFactory> */
    use HasFactory;
    protected $table = 'vendedores';


    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productos(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
