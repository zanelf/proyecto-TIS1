<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        if (config('database.default') === 'pgsql') {
            DB::statement("CREATE DOMAIN S_I AS varchar(6) CHECK (VALUE ~ '^\d{4}-\d{1}$')");
            DB::statement("CREATE DOMAIN T_hab AS varchar(5) CHECK (VALUE IN ('PrIng', 'PrInv', 'PrTut'))");
            DB::statement("CREATE DOMAIN T_prof AS varchar(10) CHECK (VALUE IN ('Guia', 'Co-Guia', 'Comision', 'Tutor'))");
        }

        Schema::create('habilitacion', function (Blueprint $table) {
            $table->id('id_habilitacion');
            $table->string('rut_alumno', 10)->nullable(false);
            $table->decimal('Nota', 2, 1)->nullable();
            $table->date('Fecha_registro_nota')->nullable();
            $table->string('Nombre_empresa', 40)->nullable();
            $table->string('Nombre_Supervisor_Empresa', 30)->nullable();
            
            // este if es para que cree la tabla aun si se genera algun error en los dominios
            if (config('database.default') === 'pgsql') {
                $table->addColumn('S_I', 'semestre_inicio')->nullable(false); 
                $table->addColumn('T_hab', 't_habilitacion')->nullable(false); 
            } else {
                // Fallback for other databases
                $table->string('semestre_inicio', 1);
                $table->string('T_habilitacion', 1);
            }
            
            // Foreign key constraint
            $table->foreign('rut_alumno', 'FK_Habilitacion_Alumno')
                  ->references('rut_alumno')
                  ->on('alumno')
                  ->onDelete('cascade');
        });



        Schema::create('p_h', function (Blueprint $table) {
            $table->integer('id_habilitacion')->nullable(false);
            $table->string('rut_profesor', 10)->nullable(false);
            if (config('database.default') === 'pgsql') {
                $table->addColumn('T_prof', 'tipo_profesor'); 
            } else {
                $table->string('Tipo_profesor', 1);
            }

            $table->primary(['id_habilitacion', 'rut_profesor', 'Tipo_profesor']);
            
            $table->foreign('id_habilitacion', 'FK_PH_Habilitacion')
                  ->references('id_habilitacion')
                  ->on('habilitacion')
                  ->onDelete('cascade');                  
            $table->foreign('rut_profesor', 'FK_PH_Profesor')
                  ->references('rut_profesor')
                  ->on('profesor');
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        if (config('database.default') === 'pgsql') {
            DB::statement('DROP DOMAIN IF EXISTS T_prof');
            DB::statement('DROP DOMAIN IF EXISTS T_hab');
            DB::statement('DROP DOMAIN IF EXISTS S_I');
        }
        Schema::dropIfExists('habilitacion');
        Schema::dropIfExists('p_h');



    }
};


