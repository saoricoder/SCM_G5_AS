<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class citas extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'paciente_id', 'doctor_id', 'fecha_cita', 'hora_cita', 'estado', 'motivo', 'notas'
    ];

    protected $casts = [
        'fecha_cita' => 'date',
    ];

    public function paciente()
    {
        return $this->belongsTo(pacientes::class);
    }

    public function doctor()
    {
        return $this->belongsTo(doctores::class);
    }
}
