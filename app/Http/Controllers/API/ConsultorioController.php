<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    /**
     * Muestra una lista de todos los consultorios. (GET /api/consultorios)
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Obtiene todos los consultorios
        $consultorios = Consultorio::all(); 
        
        return response()->json([
            'success' => true,
            'data' => $consultorios
        ], 200);
    }

    /**
     * Almacena un nuevo consultorio. (POST /api/consultorios)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:consultorios,nombre',
            'ubicacion' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1',
            'equipamiento' => 'nullable|string',
        ]);

        try {
            $consultorio = Consultorio::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Consultorio creado exitosamente',
                'data' => $consultorio
            ], 201); // 201 Created

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el consultorio: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Muestra un consultorio específico. (GET /api/consultorios/{id})
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $consultorio = Consultorio::find($id);

        if (!$consultorio) {
            return response()->json([
                'success' => false,
                'message' => 'Consultorio no encontrado'
            ], 404); // 404 Not Found
        }

        return response()->json([
            'success' => true,
            'data' => $consultorio
        ], 200);
    }

    /**
     * Actualiza un consultorio existente. (PUT/PATCH /api/consultorios/{id})
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $consultorio = Consultorio::find($id);

        if (!$consultorio) {
            return response()->json([
                'success' => false,
                'message' => 'Consultorio no encontrado'
            ], 404);
        }

        $request->validate([
            // 'nombre' debe ser único, excepto para el consultorio actual
            'nombre' => 'sometimes|required|string|max:255|unique:consultorios,nombre,' . $id, 
            'ubicacion' => 'sometimes|required|string|max:255',
            'capacidad' => 'sometimes|required|integer|min:1',
            'equipamiento' => 'nullable|string',
        ]);

        try {
            $consultorio->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Consultorio actualizado exitosamente',
                'data' => $consultorio
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el consultorio: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Elimina un consultorio. (DELETE /api/consultorios/{id})
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $consultorio = Consultorio::find($id);

        if (!$consultorio) {
            return response()->json([
                'success' => false,
                'message' => 'Consultorio no encontrado'
            ], 404);
        }

        try {
            $consultorio->delete();

            return response()->json([
                'success' => true,
                'message' => 'Consultorio eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el consultorio: ' . $e->getMessage()
            ], 500);
        }
    }
}