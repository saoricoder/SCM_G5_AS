<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Consultorio; // <<-- CORREGIDO: Línea de IMPORTACIÓN AÑADIDA

class ConsultoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CORRECCIÓN CLAVE: Usamos Consultorio::factory() (PascalCase, singular)
        Consultorio::factory()->count(20)->create(); 
    }
}