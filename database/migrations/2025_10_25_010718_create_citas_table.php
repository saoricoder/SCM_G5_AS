<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Deshabilitamos temporalmente la verificación de llaves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctores')->onDelete('cascade');
            
            // CORRECCIÓN CLAVE: Agregamos la clave foránea a la tabla 'consultorios'
            $table->foreignId('consultorio_id')->constrained('consultorios')->onDelete('cascade'); 
            
            $table->date('fecha');
            $table->time('hora');
            $table->string('motivo', 255);
            $table->enum('estado', ['Pendiente', 'Confirmada', 'Cancelada', 'Completada'])->default('Pendiente');
            $table->text('notas_internas')->nullable();
            $table->timestamps();

            $table->index('paciente_id');
            $table->index('doctor_id');
            $table->index('consultorio_id'); // Índice para la nueva columna
            $table->index('estado');
        });

        // Volvemos a habilitar la verificación
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};