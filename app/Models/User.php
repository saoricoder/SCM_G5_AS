<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'fecha_nacimiento',
        'sexo',
        'numero_seguro',
        'historial_medico',
        'contacto_emergencia',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nacimiento' => 'date',
    ];

    // Relaciones según sea necesario
    public function citasComoPaciente()
    {
        return $this->hasMany(Cita::class, 'paciente_id');
    }

    public function citasComoDoctor()
    {
        return $this->hasMany(Cita::class, 'doctor_id');
    }

    public function historialesMedicos()
    {
        return $this->hasMany(HistorialMedico::class, 'paciente_id');
    }
}
