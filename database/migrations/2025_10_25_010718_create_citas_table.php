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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctores')->onDelete('cascade');
            $table->date('fecha_cita');
            $table->time('hora_cita');
            $table->enum('estado', ['programada', 'confirmada', 'completada', 'cancelada'])->default('programada');
            $table->text('motivo');
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->index('paciente_id');
            $table->index('doctor_id');
            $table->index(['fecha_cita', 'hora_cita']);
            
            // Evitar citas duplicadas para el mismo doctor en misma fecha/hora
            $table->unique(['doctor_id', 'fecha_cita', 'hora_cita']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
