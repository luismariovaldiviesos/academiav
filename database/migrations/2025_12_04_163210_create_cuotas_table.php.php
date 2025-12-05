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
         Schema::create('cuotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matricula_id')
                  ->constrained('matriculas')
                  ->cascadeOnDelete();
            $table->enum('tipo', ['matricula', 'mensual']);
            // Para "mensual" usamos 'YYYY-MM'; para "matricula" puede ser null o el mes actual
            $table->string('periodo', 7)->nullable(); // '2025-11'
            $table->decimal('monto_cuota', 10, 2);
            $table->decimal('saldo_pendiente', 10, 2);
            $table->enum('estado', ['Pendiente', 'Parcial', 'Pagada'])
                  ->default('Pendiente');
            $table->date('fecha_generacion');
            $table->date('fecha_vencimiento')->nullable();
            $table->timestamps();
            // Evitar duplicar cuota mensual para mismo periodo
            $table->unique(['matricula_id', 'tipo', 'periodo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuotas');
    }
};
