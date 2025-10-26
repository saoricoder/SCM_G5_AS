@extends('layouts.app')

@section('content')
<div x-data="dashboard()">
    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Total Doctores</h3>
            <p class="text-3xl font-bold text-blue-600" x-text="stats.doctores"></p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Total Pacientes</h3>
            <p class="text-3xl font-bold text-green-600" x-text="stats.pacientes"></p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Citas Hoy</h3>
            <p class="text-3xl font-bold text-yellow-600" x-text="stats.citasHoy"></p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Especialidades</h3>
            <p class="text-3xl font-bold text-purple-600" x-text="stats.especialidades"></p>
        </div>
    </div>

    <!-- Citas Recientes -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h2 class="text-xl font-semibold">Citas Recientes</h2>
        </div>
        <div class="p-6">
            <div x-html="citasTable"></div>
        </div>
    </div>
</div>

<script>
function dashboard() {
    return {
        stats: {
            doctores: 0,
            pacientes: 0,
            citasHoy: 0,
            especialidades: 0
        },
        citasTable: 'Cargando...',
        
        init() {
            this.cargarEstadisticas();
            this.cargarCitasRecientes();
        },

        async cargarEstadisticas() {
            try {
                const [doctoresRes, pacientesRes, citasRes, especialidadesRes] = await Promise.all([
                    fetch('/api/doctores'),
                    fetch('/api/pacientes'),
                    fetch('/api/citas'),
                    fetch('/api/especialidades')
                ]);

                const doctores = await doctoresRes.json();
                const pacientes = await pacientesRes.json();
                const citas = await citasRes.json();
                const especialidades = await especialidadesRes.json();

                this.stats = {
                    doctores: doctores.length,
                    pacientes: pacientes.length,
                    citasHoy: citas.length,
                    especialidades: especialidades.length
                };
            } catch (error) {
                console.error('Error cargando estadísticas:', error);
            }
        },

        async cargarCitasRecientes() {
            try {
                const response = await fetch('/api/citas');
                const citas = await response.json();

                if (citas.length === 0) {
                    this.citasTable = '<p class="text-gray-500">No hay citas programadas</p>';
                    return;
                }

                this.citasTable = `
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-2 text-left">Paciente</th>
                                    <th class="px-4 py-2 text-left">Doctor</th>
                                    <th class="px-4 py-2 text-left">Fecha</th>
                                    <th class="px-4 py-2 text-left">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${citas.slice(0, 5).map(cita => `
                                    <tr class="border-b">
                                        <td class="px-4 py-2">${cita.paciente.nombre} ${cita.paciente.apellido}</td>
                                        <td class="px-4 py-2">Dr. ${cita.doctor.nombre} ${cita.doctor.apellido}</td>
                                        <td class="px-4 py-2">${cita.fecha_cita} ${cita.hora_cita}</td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                                ${cita.estado}
                                            </span>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                `;
            } catch (error) {
                console.error('Error cargando citas:', error);
                this.citasTable = '<p class="text-red-500">Error cargando citas</p>';
            }
        }
    }
}
</script>
@endsection