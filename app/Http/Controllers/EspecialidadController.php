<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\especialidades;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = especialidades::all();
        return response()->json($especialidades);
    }

    public function store(Request $request)
    {
        $especialidad = especialidades::create($request->all());
        return response()->json($especialidad, 201);
    }

    public function show($id)
    {
        $especialidad = especialidades::find($id);
        return response()->json($especialidad);
    }

    public function update(Request $request, $id)
    {
        $especialidad = especialidades::find($id);
        $especialidad->update($request->all());
        return response()->json($especialidad);
    }

    public function destroy($id)
    {
        especialidades::destroy($id);
        return response()->json(['message' => 'Especialidad eliminada']);
    }
}