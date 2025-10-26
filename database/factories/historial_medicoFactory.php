<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\pacientes;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class historial_medicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $alergias = [
            'Ninguna conocida',
            'Penicilina',
            'Mariscos',
            'Polen',
            'Ácaros',
            'Latex',
            'Huevo',
            'Frutos secos'
        ];

        $enfermedades = [
            'Ninguna',
            'Hipertensión arterial',
            'Diabetes tipo 2',
            'Asma',
            'Artritis',
            'Epilepsia',
            'Migraña',
            'Enfermedad tiroidea'
        ];

        $cirugias = [
            'Ninguna',
            'Apendicectomía',
            'Colecistectomía',
            'Amigdalectomía',
            'Cesárea',
            'Artroscopía de rodilla',
            'Cirugía de cataratas'
        ];

        return [
            'paciente_id' => pacientes::inRandomOrder()->first()?->id ?? pacientes::factory(),
            'alergias' => $this->faker->randomElement($alergias),
            'enfermedades_cronicas' => $this->faker->randomElement($enfermedades),
            'cirugias_previas' => $this->faker->randomElement($cirugias),
            'medicamentos_actuales' => $this->faker->randomElement([
                'Ninguno',
                'Losartán 50mg',
                'Metformina 500mg',
                'Atorvastatina 20mg',
                'Salbutamol inhalador',
                'Levotiroxina 50mcg'
            ]),
            'notas_adicionales' => $this->faker->optional(0.7)->sentence(),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    
    }
}
