<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/doctores', [PageController::class, 'doctores'])->name('doctores');
Route::get('/pacientes', [PageController::class, 'pacientes'])->name('pacientes');
Route::get('/citas', [PageController::class, 'citas'])->name('citas');
Route::get('/especialidades', [PageController::class, 'especialidades'])->name('especialidades');
Route::get('/historial-medico', [PageController::class, 'historialMedico'])->name('historial-medico');