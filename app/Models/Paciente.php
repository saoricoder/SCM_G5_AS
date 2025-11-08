<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes'; // Especificar nombre de tabla

    protected $fillable = [
        'nombre', 'apellido', 'fecha_nacimiento', 'telefono', 'email', 'direccion'
    ];

    public function citas()
    {
        return $this->hasMany(citas::class);
    }

    public function historialMedico()
    {
        return $this->hasOne(historial_medico::class);
    }

    public function tratamientos()
    {
        return $this->hasMany(tratamiento::class);
    }
}
