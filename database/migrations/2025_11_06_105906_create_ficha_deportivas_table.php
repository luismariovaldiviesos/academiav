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
        Schema::create('ficha_deportivas', function (Blueprint $table) {
            $table->id();
             $table->foreignId('alumno_id')
                  ->constrained('alumnos')
                  ->cascadeOnDelete();

            // Campos solicitados
            $table->string('datos_camiseta', 120)->nullable();
            $table->unsignedSmallInteger('numero_camiseta')->nullable();
            $table->string('talla_camiseta', 10)->nullable();
            $table->string('posicion_principal', 50)->nullable();
            $table->string('otra_posicion', 50)->nullable();
            $table->string('lateralidad', 20)->nullable(); // Diestro/Zurdo/Ambidiestro
            $table->string('academia_anterior', 150)->nullable();
            $table->unsignedSmallInteger('años_practica')->nullable();
            $table->timestamps();

            // 1:1 asegurado
            $table->unique('alumno_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_deportivas');
    }
};
