<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Este código llama a los 8 Seeders individuales que ya tienes,
     * en el orden correcto para poblar todas tus tablas y evitar errores de dependencia.
     */
    public function run(): void
    {
        // LLAMAR A LOS SEEDERS EN ORDEN DE DEPENDENCIA
        // 1. Tablas Raíz (Sin dependencias)
        $this->call([
            UsersSeeder::class,          // Para la tabla 'users'
            EspecialidadesSeeder::class, // Para la tabla 'especialidades'
            PacientesSeeder::class,      // Para la tabla 'pacientes'
            ConsultoriosSeeder::class,   // Para la tabla 'consultorios'
        ]);

        // 2. Tablas de Nivel Intermedio (Dependen de las raíces)
        $this->call([
            DoctoresSeeder::class,       // Depende de 'especialidades'
            HistorialMedicoSeeder::class,// Depende de 'pacientes'
        ]);

        // 3. Tablas Finales (Dependencias cruzadas)
        $this->call([
            CitasSeeder::class,          // Depende de 'doctores', 'pacientes', 'consultorios'
            TratamientoSeeder::class,    // Depende de 'doctores', 'historial_medico'
        ]);
    }
}