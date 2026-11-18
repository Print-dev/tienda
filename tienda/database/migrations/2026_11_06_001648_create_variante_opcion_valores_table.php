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
        Schema::create('variante_opcion_valores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_variante_id')->constrained('producto_variantes')->onDelete('cascade');
            $table->foreignId('opcion_valor_id')->constrained('opcion_valores')->onDelete('cascade');
            $table->unique(['producto_variante_id', 'opcion_valor_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variante_opcion_valores');
    }
};
