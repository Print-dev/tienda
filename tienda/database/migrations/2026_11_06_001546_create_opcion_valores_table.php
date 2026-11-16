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
        Schema::create('opcion_valores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opcion_id')->constrained('opciones')->onDelete('cascade');
            $table->string('valor');
            $table->char('color_hex', 7)->nullable();
            $table->integer('posicion')->default(0);
            $table->unique(['opcion_id', 'valor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opcion_valores');
    }
};
