<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\pacientes;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = pacientes::all();
        return response()->json($pacientes);
    }

    public function store(Request $request)
    {
        $paciente = pacientes::create($request->all());
        return response()->json($paciente, 201);
    }

    public function show($id)
    {
        $paciente = pacientes::find($id);
        return response()->json($paciente);
    }

    public function update(Request $request, $id)
    {
        $paciente = pacientes::find($id);
        $paciente->update($request->all());
        return response()->json($paciente);
    }

    public function destroy($id)
    {
        pacientes::destroy($id);
        return response()->json(['message' => 'Paciente eliminado']);
    }
}