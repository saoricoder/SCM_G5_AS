@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Especialidades</h1>

    @if(isset($especialidades) && $especialidades->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($especialidades as $esp)
                <div class="bg-white rounded shadow p-4">
                    <h2 class="text-lg font-semibold">{{ $esp->nombre }}</h2>
                    <p class="text-gray-600 mt-2">{{ $esp->descripcion }}</p>
                    <p class="text-sm text-gray-500 mt-2">Doctores: {{ $esp->doctores_count }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">No hay especialidades registradas.</p>
    @endif
</div>
@endsection