<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class doctores extends Model
{
     use HasFactory;

    protected $table = 'doctores'; // Especificar nombre de tabla

    protected $fillable = [
        'nombre', 'apellido', 'especialidad_id', 'telefono', 'email', 'licencia'
    ];

    public function especialidad()
    {
        return $this->belongsTo(especialidades::class);
    }

    public function citas()
    {
        return $this->hasMany(citas::class);
    }

    public function consultorio()
    {
        return $this->hasOne(consultorios::class);
    }
}
