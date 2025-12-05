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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')
                  ->constrained('alumnos')
                  ->cascadeOnDelete();
            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->restrictOnDelete();
            $table->date('fecha_matricula');
            $table->enum('estado', ['Activa', 'Suspendida', 'Inactiva'])->default('Activa');
            $table->decimal('costo_matricula', 10, 2)->nullable(); // null = no aplica
            $table->decimal('costo_mensual', 10, 2);
            $table->text('observaciones')->nullable();
            $table->timestamps();

             $table->unique(['alumno_id', 'categoria_id']); // 1 alumno 1 matrícula por categoría
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
