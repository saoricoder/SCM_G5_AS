<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\citas;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = citas::with(['paciente', 'doctor'])->get();
        return response()->json($citas);
    }

    public function store(Request $request)
    {
        $cita = citas::create($request->all());
        return response()->json($cita, 201);
    }

    public function show($id)
    {
        $cita = citas::with(['paciente', 'doctor'])->find($id);
        return response()->json($cita);
    }

    public function update(Request $request, $id)
    {
        $cita = citas::find($id);
        $cita->update($request->all());
        return response()->json($cita);
    }

    public function destroy($id)
    {
        citas::destroy($id);
        return response()->json(['message' => 'Cita eliminada']);
    }

    public function porPaciente($paciente_id)
    {
        $citas = citas::with(['paciente', 'doctor'])
                    ->where('paciente_id', $paciente_id)
                    ->get();
        return response()->json($citas);
    }

    public function porDoctor($doctor_id)
    {
        $citas = citas::with(['paciente', 'doctor'])
                    ->where('doctor_id', $doctor_id)
                    ->get();
        return response()->json($citas);
    }
}