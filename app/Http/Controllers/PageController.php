<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\doctores;
use App\Models\pacientes;
use App\Models\citas;
use App\Models\especialidades;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function doctores()
    {
        $doctores = doctores::with('especialidad')->get();
        return view('doctores', compact('doctores'));
    }

    public function pacientes()
    {
        $pacientes = pacientes::all();
        return view('pacientes', compact('pacientes'));
    }

    public function citas()
    {
        $citas = citas::with(['paciente', 'doctor'])->orderBy('fecha_cita', 'desc')->get();
        return view('citas', compact('citas'));
    }

    public function especialidades()
    {
        $especialidades = especialidades::withCount('doctores')->get();
        return view('especialidades', compact('especialidades'));
    }

    public function historialMedico()
    {
        return view('historial-medico');
    }
}