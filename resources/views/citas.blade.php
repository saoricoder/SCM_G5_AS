@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Citas</h1>

    @if(isset($citas) && $citas->count())
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 text-left">Paciente</th>
                        <th class="px-4 py-2 text-left">Doctor</th>
                        <th class="px-4 py-2 text-left">Fecha</th>
                        <th class="px-4 py-2 text-left">Hora</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                        <th class="px-4 py-2 text-left">Motivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $cita->paciente->nombre ?? '' }} {{ $cita->paciente->apellido ?? '' }}</td>
                            <td class="px-4 py-2">Dr. {{ $cita->doctor->nombre ?? '' }} {{ $cita->doctor->apellido ?? '' }}</td>
                            <td class="px-4 py-2">{{ $cita->fecha_cita }}</td>
                            <td class="px-4 py-2">{{ $cita->hora_cita }}</td>
                            <td class="px-4 py-2">{{ ucfirst($cita->estado) }}</td>
                            <td class="px-4 py-2">{{ $cita->motivo }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600">No hay citas registradas.</p>
    @endif
</div>
@endsection