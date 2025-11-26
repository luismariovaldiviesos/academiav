<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Si existiera alguna tabla previa de customers en tu base de arranque:
        Schema::dropIfExists('customers');

        Schema::create('customers', function (Blueprint $table) {
            // PK y FK al mismo tiempo (1:1 real con alumnos)
            $table->foreignId('alumno_id')
                  ->constrained('alumnos')    // FK → alumnos.id
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->primary('alumno_id');     // ← PK = alumno_id (sin id autoincrement)

            // Reusamos tus columnas del "proyecto base"
            $table->string('businame', 100);                  // nombre del representante
            $table->string('typeidenti', 10);                 // ruc/ci/etc
            $table->string('valueidenti', 20)->unique();      // número del doc (único)
            $table->string('address', 250)->nullable();
            $table->string('email', 250)->unique();
            $table->string('phone', 10);
            $table->string('notes', 500)->nullable();
            $table->timestamps();

            // ÍNDICES opcionales
            $table->index(['typeidenti', 'valueidenti']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
