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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('numerocel')->after('email')->nullable();
            $table->string('tipodocumento')->after('numerocel')->nullable();
            $table->integer('numdocumento')->after('tipodocumento')->nullable();
            $table->string('rol')->after('numdocumento')->nullable();
            $table->string('estado')->after('rol')->default('activo');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'numerocel',
                'tipodocumento',
                'numdocumento',
                'rol',
                'estado',
            ]);
        });
    }
};
