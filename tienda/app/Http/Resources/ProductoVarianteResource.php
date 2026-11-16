<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoVarianteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'sku'              => $this->sku,
            'precio_vigente'    => (float) $this->precio_vigente,
            'precio_anterior' => $this->precio_anterior,
            'precio_adquirido' => $this->precio_adquirido,
            'stock'            => $this->stock,
            //'in_stock'         => $this->in_stock,
            //'is_default'       => $this->is_default,
            'label'            => $this->when($this->relationLoaded('opcionValores'), fn () => $this->label),
            // IDs de option_values: el frontend los usa para encontrar la variante según Talla/Color elegidos
            'opcion_valor_id' => $this->whenLoaded('opcionValores', fn () => $this->opcionValores->pluck('id')->values()),
        ];
    }
}
