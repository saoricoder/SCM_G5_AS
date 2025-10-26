<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Citas Médicas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-xl font-bold">Sistema de Citas Médicas</h1>
                <div class="space-x-4">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-200">Dashboard</a>
                    <a href="{{ route('doctores') }}" class="hover:text-blue-200">Doctores</a>
                    <a href="{{ route('pacientes') }}" class="hover:text-blue-200">Pacientes</a>
                    <a href="{{ route('citas') }}" class="hover:text-blue-200">Citas</a>
                    <a href="{{ route('especialidades') }}" class="hover:text-blue-200">Especialidades</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Scripts -->
    @yield('scripts')
</body>
</html>