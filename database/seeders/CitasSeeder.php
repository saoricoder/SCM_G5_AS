<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cita; // CORRECCIÓN CLAVE: Importamos el modelo 'Cita' (singular)

class CitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // CORRECCIÓN CLAVE: Llamamos al modelo 'Cita' (singular)
        Cita::factory()->count(100)->create(); 
    }
}