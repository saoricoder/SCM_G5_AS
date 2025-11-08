<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Especialidad; // <<-- AÑADIDO: Importa el modelo correctamente (PascalCase)

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CORRECCIÓN CLAVE: Usamos Especialidad::factory() (PascalCase, singular)
        Especialidad::factory()->count(10)->create(); 
    }
}