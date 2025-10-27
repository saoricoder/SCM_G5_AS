<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\especialidades; // Importación de tu modelo

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\doctores>
 */
class doctoresFactory extends Factory
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
            
            // >> CÓDIGO AJUSTADO <<
            // Esto obtiene un ID existente. Es más simple y menos propenso a errores 
            // que el uso del operador '??' al generar 100 registros.
            'especialidad_id' => especialidades::inRandomOrder()->first()->id,
            
            'telefono' => $this->faker->numerify('09########'),
            'email' => $this->faker->unique()->safeEmail(),
            'licencia' => 'LIC-' . $this->faker->unique()->numerify('#####'),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
    public function conEspecialidad(int $especialidadId): static
    {
        return $this->state(fn (array $attributes) => [
            'especialidad_id' => $especialidadId,
        ]);
    }
}
