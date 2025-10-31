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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
             $table->string('ci', 40)->nullable()->unique(); // opcional
            $table->string('nombres', 120);
            $table->date('fecha_nacimiento');
            $table->string('colegio', 120)->nullable();
            $table->enum('genero', ['M','F','X']);
            $table->timestamps();

            $table->index(['nombres']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
