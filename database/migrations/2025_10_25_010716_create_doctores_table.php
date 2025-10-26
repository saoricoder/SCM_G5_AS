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
        Schema::create('doctores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('apellido', 255);
            $table->foreignId('especialidad_id')->constrained('especialidades')->onDelete('cascade');
            $table->string('telefono', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('licencia', 50)->nullable();
            $table->timestamps();

            $table->index('especialidad_id');
            $table->unique('licencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};
