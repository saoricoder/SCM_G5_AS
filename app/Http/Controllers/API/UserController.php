<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource. (GET /api/users)
     * Muestra una lista de todos los usuarios.
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage. (POST /api/users)
     * Crea un nuevo usuario con las validaciones de la tarea.
     */
    public function store(Request $request)
    {
        // Implementación de validaciones según los requisitos de la tarea.
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|string|min:8', // Longitud de la contraseña
            'role' => ['required', Rule::in(['admin', 'doctor', 'paciente', 'recepcionista'])],
            
            // Campos adicionales de Citas Médicas
            'fecha_nacimiento' => 'required|date',
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
            'contacto_emergencia' => 'required|string|max:15',
            'numero_seguro' => 'nullable|string|max:50',
            'historial_medico' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Contraseña encriptada
            'role' => $request->role,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'sexo' => $request->sexo,
            'contacto_emergencia' => $request->contacto_emergencia,
            'numero_seguro' => $request->numero_seguro,
            'historial_medico' => $request->historial_medico,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Usuario creado exitosamente',
            'data' => $user
        ], 201); // 201 Created
    }

    /**
     * Display the specified resource. (GET /api/users/{id})
     * Muestra un usuario específico.
     */
    public function show($id)
    {
        // Se carga con las relaciones para mostrar el perfil completo
        $user = User::with(['citasComoPaciente', 'citasComoDoctor', 'historialesMedicos'])->find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no encontrado'
            ], 404); // 404 Not Found
        }

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage. (PUT/PATCH /api/users/{id})
     * Actualiza un usuario existente.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        // Validación para la actualización (email debe ser único excepto para el usuario actual)
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'role' => ['sometimes', 'required', Rule::in(['admin', 'doctor', 'paciente', 'recepcionista'])],
            'fecha_nacimiento' => 'sometimes|required|date',
            'sexo' => ['sometimes', 'required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
            'contacto_emergencia' => 'sometimes|required|string|max:15',
            'numero_seguro' => 'nullable|string|max:50',
            'historial_medico' => 'nullable|string',
        ]);

        // Preparamos los datos para la actualización
        $data = $request->except('password');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Usuario actualizado exitosamente',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage. (DELETE /api/users/{id})
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Usuario eliminado exitosamente'
        ]);
    }
}