<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// CORRECCIÓN 1: Usar PascalCase y singular
class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'paciente_id', 'doctor_id', 'fecha_cita', 'hora_cita', 'estado', 'motivo', 'notas'
    ];

    protected $casts = [
        'fecha_cita' => 'date',
    ];

    public function paciente(): BelongsTo
    {
        // CORRECCIÓN 2: Referencia a Paciente::class (PascalCase)
        return $this->belongsTo(Paciente::class);
    }

    public function doctor(): BelongsTo
    {
        // CORRECCIÓN 2: Referencia a Doctor::class (PascalCase)
        return $this->belongsTo(Doctor::class);
    }
}