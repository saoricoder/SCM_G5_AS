<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pacientes>
 */
class PacientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'telefono' => $this->faker->numerify('55#######'),
            'email' => $this->faker->unique()->safeEmail(),
            'direccion' => $this->faker->address(),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
     public function menorDeEdad(): static
    {
        return $this->state(fn (array $attributes) => [
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-17 years', '-1 year')->format('Y-m-d'),
        ]);
    }

    public function adultoMayor(): static
    {
        return $this->state(fn (array $attributes) => [
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-80 years', '-65 years')->format('Y-m-d'),
        ]);
    }
}
