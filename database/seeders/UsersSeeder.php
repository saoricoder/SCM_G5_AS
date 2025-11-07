<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Administrador Principal',
                'email' => 'admin@clinica.com',
                'password' => Hash::make('password123'),
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
                'numero_seguro' => 'MED123456',
                'contacto_emergencia' => '+1234567891'
            ],
            [
                'name' => 'María Rodríguez',
                'email' => 'maria.rodriguez@email.com',
                'password' => Hash::make('password123'),
                'role' => 'paciente',
                'fecha_nacimiento' => '1985-05-15',
                'sexo' => 'Femenino',
                'numero_seguro' => 'PAC789012',
                'historial_medico' => 'Alergias estacionales, hipertensión controlada',
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
            User::create($user);
        }
    }
}