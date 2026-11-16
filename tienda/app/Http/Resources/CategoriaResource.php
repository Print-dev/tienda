<?php

namespace App\Http\Resources;

use App\Support\Media;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'nombre'        => $this->nombre,
            'slug'        => $this->slug,
            'imagen'       => Media::url($this->imagen),
            'children'    => CategoriaResource::collection($this->whenLoaded('children')),
            'breadcrumb'  => $this->when($this->relationLoaded('parent'), fn () => $this->breadcrumb()),
        ];
    }

    private function breadcrumb(): array
    {
        $trail = [];
        $node = $this->resource;

        while ($node) {
            array_unshift($trail, ['nombre' => $node->nombre, 'slug' => $node->slug]);
            $node = $node->relationLoaded('parent') ? $node->parent : null;
        }

        return $trail;
    }
}
