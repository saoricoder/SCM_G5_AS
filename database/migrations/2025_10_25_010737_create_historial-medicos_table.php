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
        // El nombre de la tabla con guion
        Schema::create('historial-medicos', function (Blueprint $table) {
            $table->id(); 
            // Se asegura que la columna paciente_id sea el tipo correcto (BIGINT UNSIGNED)
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade'); 
            $table->string('alergias')->nullable();
            $table->string('enfermedades_cronicas')->nullable();
            $table->string('cirugias_previas')->nullable();
            $table->string('medicamentos_actuales')->nullable();
            $table->text('notas_adicionales')->nullable();
            $table->timestamps();

            $table->index('paciente_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial-medicos');
    }
};