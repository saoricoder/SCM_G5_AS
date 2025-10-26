<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tratamiento extends Model
{
    use HasFactory;

    protected $table = 'tratamientos';

    protected $fillable = [
        'paciente_id', 'historial_medico_id', 'doctor_id', 'nombre_tratamiento',
        'descripcion', 'fecha_inicio', 'fecha_fin', 'estado'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function historialMedico()
    {
        return $this->belongsTo(HistorialMedico::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
