<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consultorio;
use App\Models\Doctor; // <<-- AÑADIDO: Importamos el modelo Doctor

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultorio>
 */
class ConsultorioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numeros = range(101, 120);
        
        // CORRECCIÓN CLAVE: Acortar los nombres de los pisos para evitar error 'Data too long' (1406)
        $pisos = ['Piso B', 'Piso 1', 'Piso 2']; 
        
        $equipamientos = [
            'Camilla de examen estándar',
            'Equipo de diagnóstico avanzado',
            'Mesa de exploración ginecológica',
            'Equipamiento de oftalmología',
            'Máquina de Rayos X portátil'
        ];

        return [
            // CORRECCIÓN CLAVE: Usamos Doctor:: (PascalCase, singular)
            'doctor_id' => Doctor::inRandomOrder()->first()?->id ?? Doctor::factory(),
            
            'numero_consultorio' => $this->faker->unique()->randomElement($numeros),
            'piso' => $this->faker->randomElement($pisos),
            'equipamiento' => $this->faker->randomElement($equipamientos),
            'disponible' => $this->faker->boolean(90), // 90% de probabilidad de estar disponible
        ];
    }
}