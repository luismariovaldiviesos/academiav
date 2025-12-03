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
        Schema::create('entrenadores', function (Blueprint $table) {
            $table->id();
             $table->string('nombre', 100);
            $table->string('ci', 20)->unique();
            $table->string('telefono', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('notas', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenadores');
    }
};
