<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void
    {
        Schema::create('alumno', function (Blueprint $table) {
            $table->string('rut_alumno', 10)->primary();
            $table->string('nombre_alumno', 50)->nullable(false);
        });

        Schema::create('profesor', function (Blueprint $table) {
            $table->string('rut_profesor', 10)->primary();
            $table->string('nombre_profesor', 50)->nullable(false);
            $table->boolean('Dinf')->default(false)->nullable(false);
        });

    }

    public function down(): void{
        Schema::dropIfExists('alumno');
        Schema::dropIfExists('profesor');
    }
};
