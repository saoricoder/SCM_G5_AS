<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// AGREGAMOS LAS IMPORTACIONES NECESARIAS (CamelCase)
use App\Models\Paciente;
use App\Models\HistorialMedico;
use App\Models\Doctor;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tratamiento>
 */
class TratamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tratamientos = [
            'Antibiótico Oral' => 'Prescripción de Amoxicilina para infección bacteriana.',
            'Fisioterapia' => 'Sesiones de rehabilitación para lesión de rodilla.',
            'Control de Diabetes' => 'Ajuste de dosis de Metformina y monitoreo de glucosa.',
            'Terapia Nutricional' => 'Dieta baja en sodio para control de hipertensión.',
            'Cirugía Menor' => 'Extracción de quiste sebáceo con anestesia local.',
            'Vacunación' => 'Aplicación de la vacuna anual contra la gripe.',
        ];
        
        // Valores de estado sincronizados con la migración Tratamientos:
        // ['pendiente', 'en_progreso', 'completado', 'cancelado']
        $estados_validos = ['pendiente', 'en_progreso', 'completado', 'cancelado'];

        $nombreTratamiento = $this->faker->randomElement(array_keys($tratamientos));
        
        return [
            // Corregimos la nomenclatura (CamelCase)
            'paciente_id' => Paciente::inRandomOrder()->first()?->id ?? Paciente::factory(), 
            
            // Corregimos la nomenclatura (CamelCase)
            'historial_medico_id' => HistorialMedico::inRandomOrder()->first()?->id ?? HistorialMedico::factory(),  
            
            // Corregimos la nomenclatura (CamelCase)
            'doctor_id' => Doctor::inRandomOrder()->first()?->id ?? Doctor::factory(),
            
            'nombre_tratamiento' => $nombreTratamiento,
            'descripcion' => $tratamientos[$nombreTratamiento],
            'fecha_inicio' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'fecha_fin' => $this->faker->optional(0.6)->dateTimeBetween('now', '+6 months'),
            
            // CORRECCIÓN CLAVE: Usamos solo los valores definidos en la migración (estado)
            'estado' => $this->faker->randomElement($estados_validos),
            
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}