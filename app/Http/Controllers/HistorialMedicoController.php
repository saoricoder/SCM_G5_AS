<?php

namespace App\Http\Controllers;

use App\Models\historial_medico;
use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    public function index()
    {
        $historiales = historial_medico::with('paciente')->get();
        return response()->json($historiales);
    }

    public function store(Request $request)
    {
        $historial = historial_medico::create($request->all());
        return response()->json($historial, 201);
    }

    public function show($id)
    {
        $historial = historial_medico::with('paciente')->find($id);
        return response()->json($historial);
    }

    public function update(Request $request, $id)
    {
        $historial = historial_medico::find($id);
        $historial->update($request->all());
        return response()->json($historial);
    }

    public function destroy($id)
    {
        historial_medico::destroy($id);
        return response()->json(['message' => 'Historial médico eliminado']);
    }
}