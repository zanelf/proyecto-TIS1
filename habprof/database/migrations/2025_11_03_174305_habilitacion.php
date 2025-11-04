<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{

     if (config('database.default') === 'pgsql'){
        DB::statement("
            CREATE TABLE Habilitacion (
            id_habilitacion serial PRIMARY KEY,
            rut_alumno varchar(10) NOT NULL,
            semestre_inicio S_I NOT NULL,
            Nota numeric(2,1),
            Fecha_registro_nota date,
            Nombre_empresa varchar(40),
            Nombre_Supervisor_Empresa varchar(30),
            T_habilitacion T_hab NOT NULL,
            CONSTRAINT FK_Habilitacion_Alumno
            FOREIGN KEY (rut_alumno) REFERENCES alumno (rut_alumno)
            );
        ");

        DB::statement("
            CREATE TABLE P_H (
            id_habilitacion integer NOT NULL,
            rut_profesor varchar(10) NOT NULL,
            Tipo_profesor T_prof NOT NULL,
            PRIMARY KEY (id_habilitacion, rut_profesor, Tipo_profesor),
            CONSTRAINT FK_PH_Habilitacion
            FOREIGN KEY (id_habilitacion) REFERENCES Habilitacion (id_habilitacion)
            ON DELETE CASCADE,
            CONSTRAINT FK_PH_Profesor
            FOREIGN KEY (rut_profesor) REFERENCES profesor (rut_profesor)
            ); 
    ");

     }
     /* Schema::create('habilitacion', function (Blueprint $table) {
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
        }


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
        });*/
    }

    

    public function down(): void{
 
        Schema::dropIfExists('habilitacion');
        Schema::dropIfExists('p_h');



    }
};


