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
        Schema::create('lesions', function (Blueprint $table) {
            $table->id();
           $table->foreignId('alumno_id')->constrained('alumnos')->cascadeOnDelete();

            // Guardaremos el primer día del mes seleccionado para normalizar YYYY-MM
            $table->date('fecha'); // vendrá de <input type="month"> como Y-m, lo convertimos a "Y-m-01"
            $table->string('lesion', 120);          // Esguince, Fractura, etc.
            $table->string('parte', 80)->nullable(); // Rodilla, Tobillo ...
            $table->enum('gravedad', ['Leve','Moderada','Grave'])->nullable();
            $table->enum('estado', ['Activa','Alta','En rehabilitación'])->nullable();
            $table->string('notas', 255)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesions');
    }
};
