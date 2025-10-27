@extends('layouts.app')

@section('content')
<div x-data="dashboard()">
    <!-- Filtros -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Filtros</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Filtro de Período -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Período</label>
                <select x-model="filtros.periodo" @change="aplicarFiltros()" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="hoy">Hoy</option>
                    <option value="semana">Esta Semana</option>
                    <option value="mes">Este Mes</option>
                    <option value="personalizado">Personalizado</option>
                </select>
            </div>
            
            <!-- Filtro de Estado -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select x-model="filtros.estado" @change="aplicarFiltros()" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">Todos los estados</option>
                    <option value="programada">Programada</option>
                    <option value="confirmada">Confirmada</option>
                    <option value="completada">Completada</option>
                    <option value="cancelada">Cancelada</option>
                </select>
            </div>
            
            <!-- Fecha Inicio (solo si es personalizado) -->
            <div x-show="filtros.periodo === 'personalizado'">
                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Inicio</label>
                <input type="date" x-model="filtros.fechaInicio" @change="aplicarFiltros()" class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
            
            <!-- Fecha Fin (solo si es personalizado) -->
            <div x-show="filtros.periodo === 'personalizado'">
                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Fin</label>
                <input type="date" x-model="filtros.fechaFin" @change="aplicarFiltros()" class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
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
            <h3 class="text-lg font-semibold text-gray-700" x-text="'Citas ' + periodoTexto"></h3>
            <p class="text-3xl font-bold text-orange-600" x-text="stats.citasPeriodo"></p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Especialidades</h3>
            <p class="text-3xl font-bold text-purple-600" x-text="stats.especialidades"></p>
        </div>
    </div>

    <!-- Estadísticas por Estado -->
    <div class="bg-white rounded-lg shadow p-6 mb-6" x-show="Object.keys(stats.citasPorEstado || {}).length > 0">
        <h2 class="text-lg font-semibold mb-4">Citas por Estado</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <template x-for="(cantidad, estado) in stats.citasPorEstado" :key="estado">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <p class="text-2xl font-bold text-gray-800" x-text="cantidad"></p>
                    <p class="text-sm text-gray-600 capitalize" x-text="estado"></p>
                </div>
            </template>
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
            citasPeriodo: 0,
            especialidades: 0,
            citasPorEstado: {}
        },
        filtros: {
            periodo: 'hoy',
            estado: '',
            fechaInicio: '',
            fechaFin: ''
        },
        periodoTexto: 'Hoy',
        citasTable: 'Cargando...',
        
        init() {
            this.cargarEstadisticas();
            this.cargarCitasRecientes();
        },

        aplicarFiltros() {
            this.actualizarPeriodoTexto();
            this.cargarEstadisticas();
            this.cargarCitasRecientes();
        },

        actualizarPeriodoTexto() {
            switch(this.filtros.periodo) {
                case 'hoy':
                    this.periodoTexto = 'Hoy';
                    break;
                case 'semana':
                    this.periodoTexto = 'Esta Semana';
                    break;
                case 'mes':
                    this.periodoTexto = 'Este Mes';
                    break;
                case 'personalizado':
                    this.periodoTexto = 'Personalizado';
                    break;
                default:
                    this.periodoTexto = 'Hoy';
            }
        },

        construirUrlStats() {
            const params = new URLSearchParams();
            params.append('periodo', this.filtros.periodo);
            
            if (this.filtros.estado) {
                params.append('estado', this.filtros.estado);
            }
            
            if (this.filtros.periodo === 'personalizado') {
                if (this.filtros.fechaInicio) {
                    params.append('fecha_inicio', this.filtros.fechaInicio);
                }
                if (this.filtros.fechaFin) {
                    params.append('fecha_fin', this.filtros.fechaFin);
                }
            }
            
            return `/api/stats?${params.toString()}`;
        },

        async cargarEstadisticas() {
            try {
                const url = this.construirUrlStats();
                const res = await fetch(url);
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const stats = await res.json();

                this.stats = {
                    doctores: Number(stats?.doctores) || 0,
                    pacientes: Number(stats?.pacientes) || 0,
                    citasHoy: Number(stats?.citasHoy) || 0,
                    citasPeriodo: Number(stats?.citasPeriodo) || 0,
                    especialidades: Number(stats?.especialidades) || 0,
                    citasPorEstado: stats?.citas_por_estado || {}
                };
            } catch (error) {
                console.error('Error cargando estadísticas:', error);
            }
        },

        async cargarCitasRecientes() {
            try {
                const response = await fetch('/api/citas');
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                const todasLasCitas = await response.json();

                // Aplicar filtros del lado cliente
                let citasFiltradas = todasLasCitas;

                // Filtrar por período
                if (this.filtros.periodo !== 'hoy' || this.filtros.periodo === 'personalizado') {
                    const hoy = new Date();
                    let fechaInicio, fechaFin;

                    switch (this.filtros.periodo) {
                        case 'semana':
                            const inicioSemana = new Date(hoy);
                            inicioSemana.setDate(hoy.getDate() - hoy.getDay());
                            fechaInicio = inicioSemana.toISOString().split('T')[0];
                            
                            const finSemana = new Date(inicioSemana);
                            finSemana.setDate(inicioSemana.getDate() + 6);
                            fechaFin = finSemana.toISOString().split('T')[0];
                            break;
                        case 'mes':
                            fechaInicio = new Date(hoy.getFullYear(), hoy.getMonth(), 1).toISOString().split('T')[0];
                            fechaFin = new Date(hoy.getFullYear(), hoy.getMonth() + 1, 0).toISOString().split('T')[0];
                            break;
                        case 'personalizado':
                            fechaInicio = this.filtros.fechaInicio;
                            fechaFin = this.filtros.fechaFin;
                            break;
                        case 'hoy':
                        default:
                            fechaInicio = fechaFin = hoy.toISOString().split('T')[0];
                            break;
                    }

                    if (fechaInicio && fechaFin) {
                        citasFiltradas = citasFiltradas.filter(cita => {
                            const fechaCita = cita.fecha_cita;
                            return fechaCita >= fechaInicio && fechaCita <= fechaFin;
                        });
                    }
                }

                // Filtrar por estado
                if (this.filtros.estado) {
                    citasFiltradas = citasFiltradas.filter(cita => cita.estado === this.filtros.estado);
                }

                if (citasFiltradas.length === 0) {
                    this.citasTable = '<p class="text-gray-500">No hay citas que coincidan con los filtros aplicados</p>';
                    return;
                }

                // Ordenar por fecha más reciente
                citasFiltradas.sort((a, b) => {
                    const fechaA = new Date(a.fecha_cita + ' ' + (a.hora_cita || '00:00'));
                    const fechaB = new Date(b.fecha_cita + ' ' + (b.hora_cita || '00:00'));
                    return fechaB - fechaA;
                });

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
                                ${citasFiltradas.slice(0, 10).map(cita => {
                                    const paciente = cita.paciente ? `${cita.paciente.nombre ?? ''} ${cita.paciente.apellido ?? ''}` : '—';
                                    const doctor = cita.doctor ? `Dr. ${cita.doctor.nombre ?? ''} ${cita.doctor.apellido ?? ''}` : '—';
                                    const fecha = cita.fecha_cita ?? '';
                                    const hora = cita.hora_cita ?? '';
                                    const estado = cita.estado ?? '';
                                    
                                    let estadoClass = 'bg-gray-100 text-gray-800';
                                    switch(estado.toLowerCase()) {
                                        case 'programada':
                                            estadoClass = 'bg-blue-100 text-blue-800';
                                            break;
                                        case 'confirmada':
                                            estadoClass = 'bg-green-100 text-green-800';
                                            break;
                                        case 'completada':
                                            estadoClass = 'bg-purple-100 text-purple-800';
                                            break;
                                        case 'cancelada':
                                            estadoClass = 'bg-red-100 text-red-800';
                                            break;
                                    }
                                    
                                    return `
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-2">${paciente}</td>
                                        <td class="px-4 py-2">${doctor}</td>
                                        <td class="px-4 py-2">${fecha} ${hora}</td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 ${estadoClass} rounded-full text-sm">
                                                ${estado}
                                            </span>
                                        </td>
                                    </tr>`;
                                }).join('')}
                            </tbody>
                        </table>
                        <div class="mt-4 text-sm text-gray-600">
                            Mostrando ${Math.min(10, citasFiltradas.length)} de ${citasFiltradas.length} citas
                        </div>
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