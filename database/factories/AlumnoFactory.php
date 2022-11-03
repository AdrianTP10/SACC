<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => fake()->name(),
            'apellido' => fake()->lastName(),
            'no_control' => fake()->unique()->randomNumber(8),
            'semestre' => fake()->numberBetween($min = 1, $max = 12),
            'carrera_id' => fake()->numberBetween($min = 1, $max = 6),
            'estatus_id' => fake()->numberBetween($min = 1, $max = 2),
            
        ];
    }
}
