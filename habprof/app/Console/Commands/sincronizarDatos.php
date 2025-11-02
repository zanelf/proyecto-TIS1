<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use App\Models\Profesor;

class SincronizarDatos extends Command
{
    protected $signature = 'sincronizar:datos';
    protected $description = 'Sincroniza los datos desde la BD secundaria (UCSC) hacia la BD principal';

    public function handle()
    {
        $this->info('Iniciando sincronización de alumnos...');

        $alumnosExternos = DB::connection('pgsql_ucsc')->table('nomina_alumnos_externos')->get();

        foreach ($alumnosExternos as $externo) {

            $existe = Alumno::where('rut_alumno', $externo->rut_alumno)->first();

            if (!$existe) {
                Alumno::create([
                    'rut_alumno' => $externo->rut_alumno,
                    'nombre_alumno' => $externo->nombre_alumno,
                ]);

                $this->info("Alumno {$externo->nombre_alumno} sincronizado.");
            }

        }

        $this->info('Iniciando sincronización de profesores...');

        $profesoresExternos = DB::connection('pgsql_ucsc')->table('nomina_profesores_externos')->get();

        foreach ($profesoresExternos as $externo) {

            $existe = Profesor::where('rut_profesor', $externo->rut_profesor)->first();

            if (!$existe) {
                Profesor::create([
                    'rut_profesor' => $externo->rut_profesor,
                    'nombre_profesor' => $externo->nombre_profesor,
                    'dinf'  => $externo->es_dinf,
                ]);

                $this->info("Profesor {$externo->nombre_profesor} sincronizado.");
            }

        }

        $this->info(' Sincronización de datos completada correctamente.');
    }
}