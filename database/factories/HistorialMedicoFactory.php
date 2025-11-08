<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;
use App\Models\HistorialMedico;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistorialMedico>
 */
class HistorialMedicoFactory extends Factory
{
    // CRUCIAL: Vinculación explícita para que el Factory use la propiedad $table del Modelo.
    protected $model = HistorialMedico::class; 

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $alergias = [
            'Ninguna conocida', 'Penicilina', 'Mariscos', 'Polen', 'Ácaros', 'Latex', 'Huevo', 'Frutos secos'
        ];

        $enfermedades = [
            'Ninguna', 'Hipertensión arterial', 'Diabetes tipo 2', 'Asma', 'Artritis', 'Epilepsia', 'Migraña', 'Enfermedad tiroidea'
        ];

        $cirugias = [
            'Ninguna', 'Apendicectomía', 'Colecistectomía', 'Amigdalectomía', 'Cesárea', 'Artroscopía de rodilla', 'Cirugía de cataratas'
        ];

        return [
            // Los campos que su Seeder estaba intentando insertar:
            'paciente_id' => Paciente::inRandomOrder()->first()?->id ?? Paciente::factory(), 
            'alergias' => $this->faker->randomElement($alergias),
            'enfermedades_cronicas' => $this->faker->randomElement($enfermedades),
            'cirugias_previas' => $this->faker->randomElement($cirugias),
            'medicamentos_actuales' => $this->faker->randomElement([
                'Ninguno', 'Losartán 50mg', 'Metformina 500mg', 'Atorvastatina 20mg', 'Salbutamol inhalador', 'Levotiroxina 50mcg'
            ]),
            'notas_adicionales' => $this->faker->optional(0.7)->sentence(),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}