<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tratamiento;
use App\Models\HistorialMedico;

class TratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Aseguramos que haya historiales médicos para asociar tratamientos
        $historiales = HistorialMedico::all();

        if ($historiales->isEmpty()) {
            return; // No sembramos si no hay historiales
        }

        Tratamiento::factory(20)->create([
            'historial_medico_id' => $historiales->random()->id,
        ]);
        
        // Creamos más tratamientos variados
        foreach (HistorialMedico::all() as $historial) {
            Tratamiento::factory(rand(1, 3))->create([
                'historial_medico_id' => $historial->id,
            ]);
        }
    }
}