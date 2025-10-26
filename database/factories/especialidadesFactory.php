<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\especialidades>
 */
class especialidadesFactory extends Factory
{
    /**
     * Define the model's default state. Faltan 100 registros
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $especialidades = [
            'Cardiología' => 'Especialidad en enfermedades del corazón y sistema cardiovascular',
            'Pediatría' => 'Especialidad en cuidado médico de niños y adolescentes',
            'Dermatología' => 'Especialidad en enfermedades de la piel, pelo y uñas',
            'Ginecología' => 'Especialidad en salud femenina y sistema reproductivo',
            'Ortopedia' => 'Especialidad en huesos, articulaciones y sistema musculoesquelético',
            'Neurología' => 'Especialidad en enfermedades del sistema nervioso',
            'Oftalmología' => 'Especialidad en enfermedades de los ojos',
            'Psiquiatría' => 'Especialidad en salud mental y trastornos emocionales'
        ];

        $especialidad = $this->faker->randomElement(array_keys($especialidades));

        return [
            'nombre' => $especialidad,
            'descripcion' => $especialidades[$especialidad],
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
