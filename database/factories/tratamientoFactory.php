<?php

namespace Database\Factories;

use App\Models\doctores;
use App\Models\pacientes;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\historial_medico;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tratamiento>
 */
class tratamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $fechaInicio = $this->faker->dateTimeBetween('-6 months', 'now');
        $fechaFin = $this->faker->optional(0.7)->dateTimeBetween($fechaInicio, '+6 months');
        
        $tratamientos = [
            'Control de Hipertensión' => 'Seguimiento y control de presión arterial',
            'Manejo de Diabetes' => 'Control de niveles de glucosa y tratamiento',
            'Terapia para Asma' => 'Manejo y prevención de crisis asmáticas',
            'Tratamiento Dermatológico' => 'Cuidado de piel y control de alergias',
            'Rehabilitación Ortopédica' => 'Recuperación post-cirugía o lesión',
            'Terapia Psicológica' => 'Sesiones de terapia y seguimiento',
            'Control Prenatal' => 'Seguimiento del embarazo',
            'Tratamiento Antibiótico' => 'Administración de antibióticos para infección'
        ];

        $nombreTratamiento = $this->faker->randomElement(array_keys($tratamientos));

        return [
            'paciente_id' => pacientes::inRandomOrder()->first()?->id ?? pacientes::factory(),
            'historial_medico_id' => historial_medico::inRandomOrder()->first()?->id ?? historial_medico::factory(),
            'doctor_id' => doctores::inRandomOrder()->first()?->id ?? doctores::factory(),
            'nombre_tratamiento' => $nombreTratamiento,
            'descripcion' => $tratamientos[$nombreTratamiento],
            'fecha_inicio' => $fechaInicio->format('Y-m-d'),
            'fecha_fin' => $fechaFin ? $fechaFin->format('Y-m-d') : null,
            'estado' => $this->faker->randomElement(['pendiente', 'en_progreso', 'completado', 'cancelado']),
            'created_at' => $fechaInicio,
            'updated_at' => $this->faker->dateTimeBetween($fechaInicio, 'now'),
        ];
    }

    public function enProgreso(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'en_progreso',
            'fecha_inicio' => $this->faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
            'fecha_fin' => $this->faker->dateTimeBetween('+1 month', '+3 months')->format('Y-m-d'),
        ]);
    }

    public function completado(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'completado',
            'fecha_inicio' => $this->faker->dateTimeBetween('-1 year', '-3 months')->format('Y-m-d'),
            'fecha_fin' => $this->faker->dateTimeBetween('-3 months', '-1 month')->format('Y-m-d'),
        ]);
    }
}
