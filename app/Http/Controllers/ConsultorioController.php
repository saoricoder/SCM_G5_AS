<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\consultorios;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    public function index()
    {
        $consultorios = consultorios::with('doctor')->get();
        return response()->json($consultorios);
    }

    public function store(Request $request)
    {
        $consultorio = consultorios::create($request->all());
        return response()->json($consultorio, 201);
    }

    public function show($id)
    {
        $consultorio = consultorios::with('doctor')->find($id);
        return response()->json($consultorio);
    }

    public function update(Request $request, $id)
    {
        $consultorio = consultorios::find($id);
        $consultorio->update($request->all());
        return response()->json($consultorio);
    }

    public function destroy($id)
    {
        consultorios::destroy($id);
        return response()->json(['message' => 'Consultorio eliminado']);
    }
}