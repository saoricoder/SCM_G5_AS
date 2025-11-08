<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        $Especialidad = Especialidad::all();
        return response()->json($Especialidad);
    }

    public function store(Request $request)
    {
        // 1. VALIDACIÓN CLAVE: Esto detiene el Error 500 al asegurar que solo 
        // los campos correctos van a la base de datos.
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        // 2. CREACIÓN: Usa los datos validados.
        try {
            $Especialidad = Especialidad::create($validatedData);

            // 3. RESPUESTA EXITOSA
            return response()->json([
                'success' => true,
                'message' => 'Especialidad creada exitosamente',
                'data' => $Especialidad
            ], 201);
        } catch (\Exception $e) {
            // Manejador de errores para debug.
            return response()->json([
                'success' => false,
                'message' => 'Error interno al crear la especialidad.',
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $Especialidad = Especialidad::find($id);
        if (!$Especialidad) {
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }
        return response()->json($Especialidad);
    }

    public function update(Request $request, $id)
    {
        $Especialidad = Especialidad::find($id);
        if (!$Especialidad) {
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }
        
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
        ]);

        $Especialidad->update($validatedData);
        return response()->json($Especialidad);
    }

    public function destroy($id)
    {
        $deleted = Especialidad::destroy($id);

        if (!$deleted) {
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }
        
        return response()->json(['message' => 'Especialidad eliminada exitosamente']);
    }
}