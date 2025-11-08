<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Importamos la clase User
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define los usuarios clave con roles y contraseñas hash
        $users = [
            [
                'name' => 'Administrador Principal',
                'email' => 'admin@clinica.com',
                'password' => Hash::make('password123'), // Contraseña hasheada
                'role' => 'admin',
                'fecha_nacimiento' => '1980-01-15',
                'sexo' => 'Masculino',
                'contacto_emergencia' => '+1234567890'
            ],
            [
                'name' => 'Dr. Carlos Mendoza',
                'email' => 'carlos.mendoza@clinica.com',
                'password' => Hash::make('password123'),
                'role' => 'doctor',
                'fecha_nacimiento' => '1975-03-20',
                'sexo' => 'Masculino',
                'contacto_emergencia' => '+1234567891'
            ],
            [
                'name' => 'María Rodríguez (Paciente)',
                'email' => 'maria.rodriguez@email.com',
                'password' => Hash::make('password123'),
                'role' => 'paciente',
                'fecha_nacimiento' => '1985-05-15',
                'sexo' => 'Femenino',
                'contacto_emergencia' => '+1234567892'
            ],
            [
                'name' => 'Recepcionista Principal',
                'email' => 'recepcion@clinica.com',
                'password' => Hash::make('password123'),
                'role' => 'recepcionista',
                'fecha_nacimiento' => '1990-08-10',
                'sexo' => 'Femenino',
                'contacto_emergencia' => '+1234567893'
            ]
        ];

        foreach ($users as $user) {
            // Usamos firstOrCreate: si el usuario existe por email, lo ignora; si no, lo crea.
            User::firstOrCreate(
                ['email' => $user['email']], // Condición de búsqueda
                $user // Datos a crear si no existe
            );
        }
    }
}