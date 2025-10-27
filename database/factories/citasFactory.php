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
    protected static array $usedSlots = [];

    public function definition(): array
    {
        $fechaCita = $this->faker->dateTimeBetween('now', '+3 months');
        $estados = ['programada', 'confirmada', 'completada', 'cancelada'];
        $horas = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'];

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

        $today = Carbon::now()->format('Y-m-d');
        $fecha = $this->faker->boolean(30) ? $today : $fechaCita->format('Y-m-d');

        // Obtener un doctor existente (se supone sembrado antes)
        $doctorId = doctores::inRandomOrder()->value('id');
        if (!$doctorId) {
            // Fallback: crear uno si por alguna razón no existe
            $doctorId = doctores::factory()->create()->id;
        }

        // Seleccionar hora evitando colisiones para (doctor, fecha)
        $slotKey = $doctorId . '|' . $fecha;
        $hora = $this->faker->randomElement($horas);
        $tries = 0;
        while (isset(self::$usedSlots[$slotKey][$hora]) && $tries < 25) {
            $hora = $this->faker->randomElement($horas);
            $tries++;
        }
        self::$usedSlots[$slotKey][$hora] = true;

        return [
            'paciente_id' => pacientes::inRandomOrder()->first()?->id ?? pacientes::factory(),
            'doctor_id' => $doctorId,
            'fecha_cita' => $fecha,
            'hora_cita' => $hora,
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

