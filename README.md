<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Sistema de Citas Médicas (SCM)

Este proyecto es un sistema de gestión de citas médicas desarrollado con Laravel. Permite administrar pacientes, doctores, especialidades, consultorios, citas, historiales médicos y tratamientos.

## Requisitos

- PHP >= 8.1
- Composer
- MySQL
- Node.js y NPM (para los assets)

## Instalación

1. Clonar el repositorio:
   ```
   git clone <url-del-repositorio>
   cd SCM
   ```

2. Instalar dependencias de PHP:
   ```
   composer install
   ```

3. Copiar el archivo de entorno:
   ```
   cp .env.example .env
   ```

4. Generar clave de aplicación:
   ```
   php artisan key:generate
   ```

5. Configurar la base de datos en el archivo `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sistema_citas_medicas1
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Crear la base de datos en MySQL:
   ```
   mysql -u root -p
   CREATE DATABASE sistema_citas_medicas1;
   exit
   ```

7. Ejecutar las migraciones y seeders:
   ```
   php artisan migrate:fresh
   php artisan db:seed
   php artisan db:seed --class=PacientesSeeder
   php artisan db:seed --class=CitasSeeder
   php artisan db:seed --class=ConsultoriosSeeder
   php artisan db:seed --class=EspecialidadesSeeder
   php artisan db:seed --class=Historial_medicoSeed
   php artisan db:seed --class=TratamientoSeeder 
   ```

## Ejecución del proyecto

1. Iniciar el servidor de desarrollo:
   ```
   php artisan serve
   ```

2. Acceder a la aplicación en el navegador:
   ```
   http://localhost:8000
   ```

3. Rutas principales del sistema:
   ```
   # Página principal
   http://localhost:8000/

   # Rutas de autenticación
   http://localhost:8000/login
   http://localhost:8000/register
   
   # Rutas de pacientes
   http://localhost:8000/api/pacientes
   http://localhost:8000/pacientes/create
   http://localhost:8000/pacientes/{id}
   http://localhost:8000/pacientes/{id}/edit
   
   # Rutas de doctores
   http://localhost:8000/api/doctores
   http://localhost:8000/doctores/create
   http://localhost:8000/doctores/{id}
   http://localhost:8000/doctores/{id}/edit
   
   # Rutas de especialidades
   http://localhost:8000/api/especialidades
   http://localhost:8000/especialidades/create
   http://localhost:8000/especialidades/{id}
   http://localhost:8000/especialidades/{id}/edit
   
   # Rutas de consultorios
   http://localhost:8000/api/consultorios
   http://localhost:8000/consultorios/create
   http://localhost:8000/consultorios/{id}
   http://localhost:8000/consultorios/{id}/edit
   
   # Rutas de citas
   http://localhost:8000/api/citas
   http://localhost:8000/citas/create
   http://localhost:8000/citas/{id}
   http://localhost:8000/citas/{id}/edit
   
   # Rutas de historiales médicos
   http://localhost:8000/api/historial-medicos
   http://localhost:8000/historial-medicos/create
   http://localhost:8000/historial-medicos/{id}
   http://localhost:8000/historial-medicos/{id}/edit
   
   # Rutas de tratamientos
   http://localhost:8000/api/tratamientos
   http://localhost:8000/tratamientos/create
   http://localhost:8000/tratamientos/{id}
   http://localhost:8000/tratamientos/{id}/edit
   ```

## Estructura del proyecto

El sistema cuenta con los siguientes modelos:
- User (Usuarios)
- Pacientes
- Doctores
- Especialidades
- Consultorios
- Citas
- Historial_medico
- Tratamiento

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
