<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultorio extends Model
{
    use HasFactory;

    protected $table = 'consultorios';

    protected $fillable = [
        'doctor_id', 'numero_consultorio', 'piso', 'equipamiento', 'disponible'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
