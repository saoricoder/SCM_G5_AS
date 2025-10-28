<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\doctores;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Devolver todos los doctores con sus especialidades
        $doctores = doctores::with('especialidad')->get();
        return response()->json($doctores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'especialidad_id' => 'required|exists:especialidades,id',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:doctores',
            'licencia' => 'required|string|max:50'
        ]);

        $doctor = doctores::create($request->all());
        return response()->json($doctor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctor = doctores::with('especialidad')->find($id);
        
        if (!$doctor) {
            return response()->json(['message' => 'Doctor no encontrado'], 404);
        }

        return response()->json($doctor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $doctor = doctores::find($id);
        
        if (!$doctor) {
            return response()->json(['message' => 'Doctor no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'especialidad_id' => 'sometimes|exists:especialidades,id',
            'telefono' => 'nullable|string|max:20',
            'email' => 'sometimes|email|unique:doctores,email,' . $id,
            'licencia' => 'sometimes|string|max:50'
        ]);

        $doctor->update($request->all());
        return response()->json($doctor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = doctores::find($id);
        
        if (!$doctor) {
            return response()->json(['message' => 'Doctor no encontrado'], 404);
        }

        $doctor->delete();
        return response()->json(['message' => 'Doctor eliminado correctamente']);
    }

    /**
     * Método adicional para buscar doctores por especialidad
     */
    public function porEspecialidad($especialidad_id)
    {
        $doctores = doctores::with('especialidad')
                        ->where('especialidad_id', $especialidad_id)
                        ->get();
        
        return response()->json($doctores);
    }
}