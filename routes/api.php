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

// Endpoint de estadísticas para el dashboard
Route::get('/stats', function (Request $request) {
    $doctores = \App\Models\doctores::count();
    $pacientes = \App\Models\pacientes::count();
    $especialidades = \App\Models\especialidades::count();
    
    // Filtros de fecha
    $fechaInicio = $request->get('fecha_inicio');
    $fechaFin = $request->get('fecha_fin');
    $periodo = $request->get('periodo', 'hoy'); // hoy, semana, mes
    $estado = $request->get('estado');
    
    // Configurar fechas según el período
    $hoy = \Carbon\Carbon::now();
    switch ($periodo) {
        case 'semana':
            $fechaInicio = $hoy->startOfWeek()->format('Y-m-d');
            $fechaFin = $hoy->endOfWeek()->format('Y-m-d');
            break;
        case 'mes':
            $fechaInicio = $hoy->startOfMonth()->format('Y-m-d');
            $fechaFin = $hoy->endOfMonth()->format('Y-m-d');
            break;
        case 'hoy':
        default:
            $fechaInicio = $fechaFin = $hoy->format('Y-m-d');
            break;
    }
    
    // Si se proporcionan fechas específicas, usarlas
    if ($request->has('fecha_inicio')) {
        $fechaInicio = $request->get('fecha_inicio');
    }
    if ($request->has('fecha_fin')) {
        $fechaFin = $request->get('fecha_fin');
    }
    
    // Construir query para citas con filtros
    $citasQuery = \App\Models\citas::whereBetween('fecha_cita', [$fechaInicio, $fechaFin]);
    
    if ($estado) {
        $citasQuery->where('estado', $estado);
    }
    
    $citasFiltradas = $citasQuery->count();
    
    // Obtener conteos por estado para el período
    $citasPorEstado = \App\Models\citas::whereBetween('fecha_cita', [$fechaInicio, $fechaFin])
        ->selectRaw('estado, COUNT(*) as total')
        ->groupBy('estado')
        ->pluck('total', 'estado')
        ->toArray();

    return response()->json([
        'doctores' => $doctores,
        'pacientes' => $pacientes,
        'citasHoy' => $periodo === 'hoy' ? $citasFiltradas : \App\Models\citas::where('fecha_cita', $hoy->format('Y-m-d'))->count(),
        'citasPeriodo' => $citasFiltradas,
        'especialidades' => $especialidades,
        'periodo' => $periodo,
        'fecha_inicio' => $fechaInicio,
        'fecha_fin' => $fechaFin,
        'estado_filtro' => $estado,
        'citas_por_estado' => $citasPorEstado,
    ]);
});