<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function doctores()
    {
        return view('doctores');
    }

    public function pacientes()
    {
        return view('pacientes');
    }

    public function citas()
    {
        return view('citas');
    }

    public function especialidades()
    {
        return view('especialidades');
    }

    public function historialMedico()
    {
        return view('historial-medico');
    }
}