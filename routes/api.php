<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
// Importamos los controladores de la clínica para evitar el uso de FQCN en Route::apiResource
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\TratamientoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas públicas de autenticación (sin protección)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con Sanctum (Requieren token)
Route::middleware('auth:sanctum')->group(function () {
    // Autenticación
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'userProfile']);

    // Gestión de usuarios (CRUD)
    Route::apiResource('users', UserController::class);
    
    // Rutas del sistema de clínica (CRUD)
    Route::apiResource('doctores', DoctorController::class);
    Route::apiResource('pacientes', PacienteController::class);
    
    // Rutas de Citas (Incluye las rutas personalizadas de búsqueda por ID)
    Route::apiResource('citas', CitaController::class);
    Route::get('citas/paciente/{paciente_id}', [CitaController::class, 'porPaciente']);
    Route::get('citas/doctor/{doctor_id}', [CitaController::class, 'porDoctor']);

    // Otros recursos de la clínica
    Route::apiResource('especialidades', EspecialidadController::class);
    Route::apiResource('consultorios', ConsultorioController::class);
    // Nota: El guion ('historial-medico') es importante si así se llama el controlador.
    Route::apiResource('historial-medico', HistorialMedicoController::class); 
    Route::apiResource('tratamientos', TratamientoController::class);
});

// Ruta de verificación de salud del microservicio
Route::get('/health', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Microservicio de Gestión de Usuarios funcionando correctamente',
        'timestamp' => now()->toDateTimeString()
    ]);
});