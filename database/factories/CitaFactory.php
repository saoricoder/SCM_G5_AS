<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cita; // Aseguramos la importación del modelo Cita
use App\Models\Doctor; // CORRECCIÓN CLAVE: Importamos el modelo Doctor
use App\Models\Paciente;
use App\Models\Consultorio;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    protected $model = Cita::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaCita = $this->faker->dateTimeBetween('-1 month', '+6 months');
        $today = Carbon::now()->format('Y-m-d');
        $fecha = $this->faker->boolean(30) ? $today : $fechaCita->format('Y-m-d');

        // Obtener un doctor existente (se supone sembrado antes)
        // CORRECCIÓN: Usamos el modelo Doctor (CamelCase, singular)
        $doctorId = Doctor::inRandomOrder()->value('id'); 
        if (!$doctorId) {
            // Fallback: crear uno si por alguna razón no existe
            $doctorId = Doctor::factory()->create()->id;
        }

        // Obtener un paciente existente
        $pacienteId = Paciente::inRandomOrder()->value('id');
        if (!$pacienteId) {
            $pacienteId = Paciente::factory()->create()->id;
        }

        // Obtener un consultorio existente
        $consultorioId = Consultorio::inRandomOrder()->value('id');
        if (!$consultorioId) {
            $consultorioId = Consultorio::factory()->create()->id;
        }


        return [
            'doctor_id' => $doctorId,
            'paciente_id' => $pacienteId,
            'consultorio_id' => $consultorioId,
            'fecha' => $fecha,
            'hora' => $this->faker->time('H:i:s'),
            'motivo' => $this->faker->sentence(3),
            'estado' => $this->faker->randomElement(['Pendiente', 'Confirmada', 'Cancelada', 'Completada']),
            'notas_internas' => $this->faker->optional(0.5)->text(150),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}