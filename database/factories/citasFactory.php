<?php

namespace Database\Factories;

use App\Models\doctores;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\pacientes;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\citas>
 * Datos de prueba para la tabla de citas
 */
class citasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $fechaCita = $this->faker->dateTimeBetween('now', '+3 months');
        $estados = ['programada', 'confirmada', 'completada', 'cancelada'];
        $horas = ['08:00', '09:00', '10:00', '11:00', '14:00', '15:00', '16:00', '17:00'];

        $motivos = [
            'Consulta general',
            'Control de rutina',
            'Seguimiento de tratamiento',
            'Chequeo anual',
            'Dolor persistente',
            'Revisión de resultados',
            'Vacunación',
            'Emergencia médica'
        ];

        return [
            'paciente_id' => pacientes::inRandomOrder()->first()?->id ?? pacientes::factory(),
            'doctor_id' => doctores::inRandomOrder()->first()?->id ?? doctores::factory(),
            'fecha_cita' => $fechaCita->format('Y-m-d'),
            'hora_cita' => $this->faker->randomElement($horas),
            'estado' => $this->faker->randomElement($estados),
            'motivo' => $this->faker->randomElement($motivos),
            'notas' => $this->faker->optional(0.6)->text(200),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }

    public function programada(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'programada',
        ]);
    }

    public function completada(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'completada',
            'fecha_cita' => $this->faker->dateTimeBetween('-3 months', '-1 day')->format('Y-m-d'),
        ]);
    }

    public function cancelada(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'cancelada',
        ]);
    }

    public function paraFecha(string $fecha): static
    {
        return $this->state(fn (array $attributes) => [
            'fecha_cita' => $fecha,
        ]);
    
    }
}
