<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registro de un nuevo usuario.
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Usuario registrado exitosamente',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error inesperado durante el registro: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Inicio de sesión del usuario.
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Inicio de sesión exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Obtener el perfil del usuario autenticado (Método de Debug Forzado).
     */
    public function userProfile()
    {
        $user = Auth::user();

        if (!$user) {
            // Caso 1: No hay usuario (Token inválido o expirado)
            return response()->json([
                'status' => 'error',
                'message' => 'No se encontró un usuario autenticado. Asegúrate de enviar un token de acceso válido en el encabezado Authorization.'
            ], 401);
        }

        try {
            // Caso 2: Usuario autenticado, se devuelven los datos principales.
            // Si el error 500 sigue ocurriendo, el problema está en la estructura de la clase User.php
            return response()->json([
                'status' => 'success',
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        } catch (\Exception $e) {
            // Caso 3: El error 500 ocurre justo al intentar acceder a $user->id o $user->name.
            // Esto forzará una respuesta JSON con el error real.
            return response()->json([
                'status' => 'fatal_debug_error_in_user_model',
                'message' => 'CRASH EN MODELO USER: Error al intentar acceder a las propiedades del usuario. Revisa App\\Models\\User.php. Causa: ' . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    /**
     * Cierre de sesión (revocar token).
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Sesión cerrada exitosamente.'
        ]);
    }
}