<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuario de prueba (idempotente)
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => Hash::make('password')]
        );

        // Orden de seeders respetando dependencias
        $this->call([
            EspecialidadesSeeder::class,
            DoctoresSeeder::class,
            PacientesSeeder::class,
            Historial_medicoSeeder::class,
            TratamientoSeeder::class,
            ConsultoriosSeeder::class,
            CitasSeeder::class,
        ]);
    }
}