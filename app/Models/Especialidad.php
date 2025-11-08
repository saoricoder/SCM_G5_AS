<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    /**
     * ¡CORRECCIÓN CRÍTICA!
     * Laravel busca la tabla 'especialidads'. Al definir explícitamente 
     * el nombre de la tabla como 'especialidades', forzamos el uso del nombre correcto
     * que está en tu migración, resolviendo el error 42S02.
     */
    protected $table = 'especialidades'; 

    protected $fillable = [
        'nombre',
        'descripcion',
    ];
    
    // Si usas relaciones, agrégalas aquí.
}
