<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente; // Importamos la clase Paciente (opcional pero buena práctica)

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
// CORRECCIÓN 1: La clase debe ser singular: PacienteFactory
class PacienteFactory extends Factory
{
    // Opcional: Especificar el modelo si el nombre de la clase no sigue la convención
    protected $model = Paciente::class;

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
            // Se mantiene el formato Y-m-d para evitar el error 1292/Fecha
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'), 
            'telefono' => $this->faker->numerify('55#######'),
            'email' => $this->faker->unique()->safeEmail(),
            'direccion' => $this->faker->address(),
            // CORRECCIÓN 3: Se eliminan created_at/updated_at porque $timestamps está en 'false' en el modelo
        ];
    }
    
    // ... métodos de estados (menorDeEdad y adultoMayor)
    
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