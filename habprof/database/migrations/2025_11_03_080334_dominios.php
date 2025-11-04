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
          DB::statement("DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_catalog.pg_type WHERE typname = 'S_I') THEN
                    CREATE DOMAIN S_I AS varchar(6)  CONSTRAINT check_S_I CHECK (VALUE ~ '^\d{4}-\d{1}$');
                END IF;
            END
            $$;");

            DB::statement("DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_catalog.pg_type WHERE typname = 'T_hab') THEN
                    CREATE DOMAIN T_hab AS varchar(6)
                        CONSTRAINT check_T_hab CHECK (VALUE IN ('Guia', 'Co-Guia', 'Comision', 'Tutor'));
                END IF;
            END
            $$;");

            DB::statement("DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_catalog.pg_type WHERE typname = 'T_prof') THEN
                    CREATE DOMAIN T_prof AS varchar(6)
                        CONSTRAINT check_T_prof CHECK (VALUE IN ('PrIng', 'PrInv', 'PrTut'));
                END IF;
            END
            $$;");
            
        }
    }

    public function down(): void{
        if (config('database.default') === 'pgsql') {
            DB::statement('DROP DOMAIN IF EXISTS T_prof');
            DB::statement('DROP DOMAIN IF EXISTS T_hab');
            DB::statement('DROP DOMAIN IF EXISTS S_I');
        }    
    }
};
