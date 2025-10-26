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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('apellido', 255);
            $table->date('fecha_nacimiento');
            $table->string('telefono', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->text('direccion')->nullable();
            $table->timestamps();
            $table->index(['nombre', 'apellido']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
