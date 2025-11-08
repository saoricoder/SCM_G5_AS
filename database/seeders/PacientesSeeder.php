<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paciente; // CORRECCIÓN 1: Usamos la clase Paciente (PascalCase)
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CORRECCIÓN 2: Usamos el nombre de la clase corregido
        Paciente::factory()->count(100)->create();
    }
}