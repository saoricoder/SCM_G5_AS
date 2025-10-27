<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class especialidades extends Model
{
     use HasFactory;

    protected $table = 'especialidades'; // Especificar nombre de tabla

    protected $fillable = ['nombre', 'descripcion'];

    public function doctores()
    {
        return $this->hasMany(doctores::class, 'especialidad_id');
    }
}
