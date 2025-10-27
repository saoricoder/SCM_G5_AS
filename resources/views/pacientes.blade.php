@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Pacientes</h1>

    @if(isset($pacientes) && $pacientes->count())
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Teléfono</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $paciente->nombre }} {{ $paciente->apellido }}</td>
                            <td class="px-4 py-2">{{ $paciente->telefono }}</td>
                            <td class="px-4 py-2">{{ $paciente->email }}</td>
                            <td class="px-4 py-2">{{ $paciente->direccion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600">No hay pacientes registrados.</p>
    @endif
</div>
@endsection