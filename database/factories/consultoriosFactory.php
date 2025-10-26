<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\doctores;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\consultorios>
 */
class consultoriosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $pisos = ['1', '2', '3', '4', '5'];
        $numeros = range(101, 510);

        $equipamientos = [
            'Estetoscopio, tensiómetro, termómetro',
            'Electrocardiógrafo, monitor de signos vitales',
            'Equipo de rayos X portátil',
            'Ecógrafo, monitor fetal',
            'Dermatoscopio, lámpara de Wood',
            'Oftalmoscopio, tonómetro',
            'Equipo de endoscopia',
            'Mesa de exploración ginecológica'
        ];

        return [
            'doctor_id' => doctores::inRandomOrder()->first()?->id ?? doctores::factory(),
            'numero_consultorio' => $this->faker->unique()->randomElement($numeros),
            'piso' => $this->faker->randomElement($pisos),
            'equipamiento' => $this->faker->randomElement($equipamientos),
            'disponible' => $this->faker->boolean(90), // 90% de probabilidad de estar disponible
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function noDisponible(): static
    {
        return $this->state(fn (array $attributes) => [
            'disponible' => false,
        ]);
    }
}
