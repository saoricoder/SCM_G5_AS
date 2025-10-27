# Sistema de Citas Médicas (SCM)

Sistema de gestión de citas médicas desarrollado con Laravel que permite administrar pacientes, doctores, especialidades, consultorios, citas, historiales médicos y tratamientos.

## Requisitos del Sistema

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js >= 16.x y NPM

## Instalación y Despliegue

### 1. Clonar el Repositorio
```bash
git clone <url-del-repositorio>
cd SCM_G5_AS
```

### 2. Instalar Dependencias
```bash
# Dependencias de PHP
composer install

# Dependencias de Node.js (opcional, para assets)
npm install
```

### 3. Configuración del Entorno
```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

### 4. Configurar Base de Datos

Editar el archivo `.env` con la configuración de tu base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_citas_medicas
DB_USERNAME=root
DB_PASSWORD=tu_password
```

### 5. Crear Base de Datos
```sql
mysql -u root -p
CREATE DATABASE sistema_citas_medicas;
exit
```

### 6. Ejecutar Migraciones y Seeders
```bash
# Ejecutar migraciones
php artisan migrate:fresh

# Poblar base de datos con datos de prueba
php artisan db:seed
```

### 7. Configurar Rutas API
El proyecto incluye rutas API que están configuradas en `bootstrap/app.php`. Las rutas están disponibles en:
- `/api/stats` - Estadísticas del dashboard
- `/api/citas` - Gestión de citas
- `/api/pacientes` - Gestión de pacientes
- `/api/doctores` - Gestión de doctores
- `/api/especialidades` - Gestión de especialidades

## Ejecución del Proyecto

### Servidor de Desarrollo
```bash
php artisan serve
```

La aplicación estará disponible en: `http://127.0.0.1:8000`

### Verificar Instalación
```bash
# Listar rutas disponibles
php artisan route:list

# Verificar estado de la base de datos
php artisan migrate:status
```

## Estructura de Rutas Principales

### Rutas Web
- `/` - Dashboard principal
- `/pacientes` - Gestión de pacientes
- `/doctores` - Gestión de doctores
- `/especialidades` - Gestión de especialidades
- `/citas` - Gestión de citas
- `/historial-medico` - Historiales médicos

### Rutas API
- `GET /api/stats` - Estadísticas del sistema
- `GET /api/citas` - Lista de citas
- `GET /api/pacientes` - Lista de pacientes
- `GET /api/doctores` - Lista de doctores
- `GET /api/especialidades` - Lista de especialidades

## Modelos del Sistema

- **User** - Usuarios del sistema
- **Pacientes** - Información de pacientes
- **Doctores** - Información de doctores
- **Especialidades** - Especialidades médicas
- **Consultorios** - Consultorios disponibles
- **Citas** - Citas médicas programadas
- **Historial_medico** - Historiales médicos
- **Tratamiento** - Tratamientos médicos

## Solución de Problemas Comunes

### Error de Rutas API no Encontradas
Si las rutas `/api/*` devuelven 404, verificar que `bootstrap/app.php` incluya:
```php
->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)
```

### Error de Relaciones en Modelos
Verificar que las claves foráneas estén correctamente definidas en las relaciones:
- `especialidades.php`: `hasMany(doctores::class, 'especialidad_id')`
- `doctores.php`: `belongsTo(especialidades::class, 'especialidad_id')`

### Permisos de Archivos (Linux/Mac)
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Regenerar autoload
composer dump-autoload

# Verificar configuración
php artisan config:show database
```
