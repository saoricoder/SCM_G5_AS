<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\historial_medico as HistorialMedico;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Historial_medicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un historial médico por cada paciente existente
        $pacientes = \App\Models\pacientes::all();
        
        foreach ($pacientes as $paciente) {
            HistorialMedico::factory()->create([
                'paciente_id' => $paciente->id
            ]);
        }
    }
}
