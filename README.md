![logo](assets/Logo-espe.png)

## Arquitectura de Software (GRUPO 5)

#### INTEGRANTES 

- GUAMIALAMA NICOLAS
- RODRIGUEZ BETTY 
- VILLAMARIN VICTOR
- DOMINGUEZ OSCAR
- POAQUIZA MARCO
- TENEMAZA ALANIS


# Sistema de Citas Médicas (SCM)

Sistema de gestión de citas médicas desarrollado con Laravel nos permite administrar pacientes, doctores, especialidades, consultorios, citas, historiales médicos y tratamientos.

## Requisitos del Sistema

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Node.js >= 16.x y NPM

## Instalación y Despliegue

### 1. Clonar el Repositorio
```bash
gh repo clone saoricoder/SCM_G5_AS
cd SCM_G5_AS
```

### 2. Instalar Dependencias
```bash
# Dependencias de PHP
composer install

# Dependencias de Node.js (opcional, para assets)
npm install
```

### 3. ACTUALIZAR MIGRACIÓN DE USUARIOS
```bash
 # Campos adicionales para Citas Médicas
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('sexo', ['Masculino', 'Femenino', 'Otro'])->nullable();
            $table->string('numero_seguro')->nullable();
            $table->text('historial_medico')->nullable();
            $table->string('contacto_emergencia')->nullable();
            $table->enum('role', ['admin', 'doctor', 'paciente', 'recepcionista'])->default('paciente');
```

### 4. ACTUALIZAR MODELO USER

Editar el archivo /Models/User.php:
```class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'fecha_nacimiento',
        'sexo',
        'numero_seguro',
        'historial_medico',
        'contacto_emergencia',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nacimiento' => 'date',
    ];

#  Relaciones según sea necesario
    public function citasComoPaciente()
    {
        return $this->hasMany(Cita::class, 'paciente_id');
    }
```

### 5.  INSTALAR LARAVEL SANCTUM


![Sanctum](image-1.png)


![DB](assets/crearDB.png)

### CREAR CONTROLADOR DE USUARIOS API

```
Controllers/API/UserController.php
```
### CREAR CONTROLADOR DE AUTENTICACIÓN

```
Controllers/API/AuthController.php
```
### CONFIGURAR RUTAS API

```
routes/api.php
```

#### Ruta de verificación de salud del microservicio
```
Route::get('/health', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Microservicio de Gestión de Usuarios funcionando correctamente',
        'timestamp' => now()->toDateTimeString()
    ]);
});
```


### CREAR SEEDER PARA USUARIOS


```
seeders/UsersSeeder.php
```
### Autenticación (Laravel Sanctum)
rutas seguras requieren un Bearer Token obtenido después de un login exitoso
![alt text](image.png)
![](assets\registro1.png)

![Sanctum](assets/login.png)



### Estructura de Rutas y Roles
La API está diseñada con diferentes niveles de acceso:


### Rutas de Administrador (role:admin)

![alt text](image-1.png)


### Rutas de Paciente (role:paciente)

![alt text](image-2.png)

### Dependencias Clave
```
Laravel Framework: Base del microservicio.

Laravel Sanctum: Manejo de la autenticación de tokens API.

MySQL: Base de datos relacional.
```

![](assets/Token.png)
![alt text](image-3.png)

![](registro.png)





![](assets/relacional.png)

### Solución de Problemas Comunes

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
## Clonar el Repositorio

- Instalar Git: Asegúrate de tener Git instalado en tu computadora. Puedes descargarlo desde git-scm.com.

- Copiar la URL: Copia la URL del repositorio: https://github.com/saoricoder/SCM_G5_AS.git.

- Abrir la Terminal/Línea de Comandos: Navega hasta la carpeta en tu computadora donde quieres guardar el proyecto.

- Ejecuta el siguiente comando:  
  git clone https://github.com/saoricoder/SCM_G5_AS.git
- Esto creará una nueva carpeta llamada SCM_G5_AS  con todos los archivos
