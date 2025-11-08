<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    // CRUCIAL: Forzamos el nombre de la tabla para que coincida con su base de datos (con guion medio).
    protected $table = 'historial-medicos'; 

    protected $fillable = [
        'paciente_id', 
        'doctor_id', 
        'cita_id',
        'diagnostico',
        'notas',
        'fecha_consulta' 
    ];
    
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }
}