<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class historial_medico extends Model
{
     use HasFactory;

    protected $table = 'historial-medicos';

    protected $fillable = [
        'paciente_id', 'alergias', 'enfermedades_cronicas', 'cirugias_previas', 
        'medicamentos_actuales', 'notas_adicionales'
    ];

    public function paciente()
    {
        return $this->belongsTo(pacientes::class);
    }

    public function tratamientos()
    {
        return $this->hasMany(tratamiento::class);
    }
}
