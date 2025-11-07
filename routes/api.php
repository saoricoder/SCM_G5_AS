<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;

// Rutas públicas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Autenticación
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'userProfile']);

    // Gestión de usuarios (CRUD)
    Route::apiResource('users', UserController::class);
    
    // Rutas existentes de tu sistema de citas
    Route::apiResource('doctores', App\Http\Controllers\DoctorController::class);
    Route::apiResource('pacientes', App\Http\Controllers\PacienteController::class);
    Route::apiResource('citas', App\Http\Controllers\CitaController::class);
    Route::apiResource('especialidades', App\Http\Controllers\EspecialidadController::class);
    Route::apiResource('consultorios', App\Http\Controllers\ConsultorioController::class);
    Route::apiResource('historial-medico', App\Http\Controllers\HistorialMedicoController::class);
    Route::apiResource('tratamientos', App\Http\Controllers\TratamientoController::class);
});

// Ruta de verificación de salud del microservicio
Route::get('/health', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Microservicio de Gestión de Usuarios funcionando correctamente',
        'timestamp' => now()->toDateTimeString()
    ]);
});