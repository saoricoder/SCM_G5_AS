<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            EspecialidadesSeeder::class,
            DoctoresSeeder::class,
            PacientesSeeder::class,
            ConsultoriosSeeder::class,
            TratamientosSeeder::class,
            CitasSeeder::class,
            HistorialMedicoSeeder::class,
        ]);
    }
}