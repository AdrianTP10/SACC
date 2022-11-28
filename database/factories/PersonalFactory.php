<?php

namespace Database\Factories;

use App\Models\Personal;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personal>
 */
class PersonalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Personal::class;

    public function definition()
    {
        return [
            'nombre' => fake()->name(),
            'apellido' => fake()->lastName(),
            'rfc' => Str::random(13),
            'departamento_id' => \App\Models\Departamento::all('id')->random()->id,
        ];
    }
}
