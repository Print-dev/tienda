<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            /* 'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'categoria_id' => null, // Puedes asignar un valor predeterminado o dejarlo como null */
        ];
    }
}
