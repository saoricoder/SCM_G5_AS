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
        Schema::create('consultorios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctores')->onDelete('cascade');
            $table->string('numero_consultorio', 20);
            $table->string('piso', 10)->nullable();
            $table->text('equipamiento')->nullable();
            $table->boolean('disponible')->default(true);
            $table->timestamps();

            $table->index('doctor_id');
            $table->unique('numero_consultorio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultorios');
    }
};
