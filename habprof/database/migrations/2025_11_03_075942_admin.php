<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    
    public function up(): void {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('ID'); // serial PRIMARY KEY
            $table->string('rut_admin', 10)->unique()->nullable(false);
            $table->string('password', 255)->nullable(false);
        });
    
    }
 
    public function down(): void {
        Schema::dropIfExists('admin');
    }
};
