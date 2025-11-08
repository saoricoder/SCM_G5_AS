<?php

namespace App\Http\Controllers;

use App\Models\Cita; // Solo importamos el modelo correcto (Cita)
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        // Usamos Cita:: en lugar de citas::
        $citas = Cita::with(['paciente', 'doctor'])->get();
        return response()->json($citas);
    }

    public function store(Request $request)
    {
        // Usamos Cita::
        $cita = Cita::create($request->all());
        return response()->json($cita, 201);
    }

    public function show($id)
    {
        // Usamos Cita::
        $cita = Cita::with(['paciente', 'doctor'])->find($id);
        return response()->json($cita);
    }

    public function update(Request $request, $id)
    {
        // Usamos Cita::
        $cita = Cita::find($id);
        $cita->update($request->all());
        return response()->json($cita);
    }

    public function destroy($id)
    {
        // Usamos Cita::
        Cita::destroy($id);
        return response()->json(['message' => 'Cita eliminada']);
    }

    public function porPaciente($paciente_id)
    {
        // Usamos Cita::
        $citas = Cita::with(['paciente', 'doctor'])
                     ->where('paciente_id', $paciente_id)
                     ->get();
        return response()->json($citas);
    }

    public function porDoctor($doctor_id)
    {
        // Usamos Cita::
        $citas = Cita::with(['paciente', 'doctor'])
                     ->where('doctor_id', $doctor_id)
                     ->get();
        return response()->json($citas);
    }
}