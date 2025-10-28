<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    public function index()
    {
        $tratamientos = Tratamiento::with(['paciente', 'doctor', 'historialMedico'])->get();
        return response()->json($tratamientos);
    }

    public function store(Request $request)
    {
        $tratamiento = Tratamiento::create($request->all());
        return response()->json($tratamiento, 201);
    }

    public function show($id)
    {
        $tratamiento = Tratamiento::with(['paciente', 'doctor', 'historialMedico'])->find($id);
        return response()->json($tratamiento);
    }

    public function update(Request $request, $id)
    {
        $tratamiento = Tratamiento::find($id);
        $tratamiento->update($request->all());
        return response()->json($tratamiento);
    }

    public function destroy($id)
    {
        Tratamiento::destroy($id);
        return response()->json(['message' => 'Tratamiento eliminado']);
    }
}