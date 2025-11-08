<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HistorialMedico; // Usando el alias correcto: HistorialMedico (PascalCase)
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistorialMedicoSeeder extends Seeder // Usando PascalCase para la clase Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un historial médico por cada paciente existente
        // NOTA: Asegúrate de que el modelo se llame 'Paciente' (P mayúscula) si usas esta línea
        $pacientes = \App\Models\Paciente::all();
        
        foreach ($pacientes as $paciente) {
            // CORRECCIÓN: Quitamos el guion
            HistorialMedico::factory()->create([
                'paciente_id' => $paciente->id
            ]);
        }
    }
}