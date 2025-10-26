<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('historial_medico_id')->constrained('historial-medicos')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctores')->onDelete('cascade');
            $table->string('nombre_tratamiento', 255);
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['pendiente', 'en_progreso', 'completado', 'cancelado'])->default('pendiente');
            $table->timestamps();

            $table->index('paciente_id');
            $table->index('doctor_id');
            $table->index('historial_medico_id');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
