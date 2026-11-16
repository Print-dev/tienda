<?php

namespace App\Http\Resources;

use App\Support\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarcaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'nombre'           => $this->nombre,
            'slug'           => $this->slug,
            'logo'           => Media::url($this->logo),
            'productos_contar' => $this->whenCounted('productos'),
        ];
    }
}
