<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.'
     */
    public function up(): void
    {
        Schema::create('historial-medicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->text('alergias')->nullable();
            $table->text('enfermedades_cronicas')->nullable();
            $table->text('cirugias_previas')->nullable();
            $table->text('medicamentos_actuales')->nullable();
            $table->text('notas_adicionales')->nullable();
            $table->timestamps();

             $table->index('paciente_id');
            $table->unique('paciente_id'); // Un paciente tiene un solo historial médico
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
