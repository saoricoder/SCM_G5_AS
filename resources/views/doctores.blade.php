@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Doctores</h1>

    @if(isset($doctores) && $doctores->count())
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Especialidad</th>
                        <th class="px-4 py-2 text-left">Teléfono</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Licencia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctores as $doctor)
                        <tr class="border-b">
                            <td class="px-4 py-2">Dr. {{ $doctor->nombre }} {{ $doctor->apellido }}</td>
                            <td class="px-4 py-2">{{ $doctor->especialidad->nombre ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $doctor->telefono }}</td>
                            <td class="px-4 py-2">{{ $doctor->email }}</td>
                            <td class="px-4 py-2">{{ $doctor->licencia }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600">No hay doctores registrados.</p>
    @endif
</div>
@endsection