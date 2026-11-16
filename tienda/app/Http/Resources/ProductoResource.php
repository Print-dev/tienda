<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            'estado' => $this->estado,
            // marca viene de la relacion con la tabla marcas, y se carga condicionalmente usando whenLoaded para evitar consultas innecesarias si la relación no está cargada.
            'marca'              => $this->whenLoaded('marca', fn () => $this->marca ? [
                'nombre' => $this->marca->nombre,
                'slug' => $this->marca->slug,
            ] : null),
        ];
    }
}
