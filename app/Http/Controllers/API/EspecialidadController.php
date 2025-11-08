<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Muestra una lista de todas las especialidades. (GET /api/especialidades)
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Obtiene todas las especialidades
        $especialidades = Especialidad::all(); 
        
        return response()->json([
            'success' => true,
            'data' => $especialidades
        ], 200);
    }

    /**
     * Almacena una nueva especialidad. (POST /api/especialidades)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre',
            'descripcion' => 'nullable|string',
        ]);

        try {
            $especialidad = Especialidad::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Especialidad creada exitosamente',
                'data' => $especialidad
            ], 201); // 201 Created

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la especialidad: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Muestra una especialidad específica. (GET /api/especialidades/{id})
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            return response()->json([
                'success' => false,
                'message' => 'Especialidad no encontrada'
            ], 404); // 404 Not Found
        }

        return response()->json([
            'success' => true,
            'data' => $especialidad
        ], 200);
    }

    /**
     * Actualiza una especialidad existente. (PUT/PATCH /api/especialidades/{id})
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            return response()->json([
                'success' => false,
                'message' => 'Especialidad no encontrada'
            ], 404);
        }

        $request->validate([
            // 'nombre' debe ser único, excepto para la especialidad actual
            'nombre' => 'sometimes|required|string|max:255|unique:especialidades,nombre,' . $id, 
            'descripcion' => 'nullable|string',
        ]);

        try {
            $especialidad->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Especialidad actualizada exitosamente',
                'data' => $especialidad
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la especialidad: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Elimina una especialidad. (DELETE /api/especialidades/{id})
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            return response()->json([
                'success' => false,
                'message' => 'Especialidad no encontrada'
            ], 404);
        }
        
        try {
            $especialidad->delete();

            return response()->json([
                'success' => true,
                'message' => 'Especialidad eliminada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la especialidad: ' . $e->getMessage()
            ], 500);
        }
    }
}