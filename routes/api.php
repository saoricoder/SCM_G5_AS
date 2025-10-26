<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\TratamientoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas API para el sistema de citas médicas
Route::apiResource('doctores', DoctorController::class);
Route::apiResource('pacientes', PacienteController::class);
Route::apiResource('citas', CitaController::class);
Route::apiResource('especialidades', EspecialidadController::class);
Route::apiResource('historial-medico', HistorialMedicoController::class);
Route::apiResource('consultorios', ConsultorioController::class);
Route::apiResource('tratamientos', TratamientoController::class);

// Rutas adicionales para búsquedas
Route::get('doctores/especialidad/{especialidad_id}', [DoctorController::class, 'porEspecialidad']);
Route::get('citas/paciente/{paciente_id}', [CitaController::class, 'porPaciente']);
Route::get('citas/doctor/{doctor_id}', [CitaController::class, 'porDoctor']);