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
        Schema::create('areas_eventos_pivot', function (Blueprint $table) {
            $table->id();
            // Chave estrangeira: Eventos.
            $table->foreignId('evento_id')->references('id')->on('eventos');
            // Chave estrangeira: Áreas de eventos.
            $table->foreignId('evento_area_id')->references('id')->on('evento_areas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas_eventos_pivot');
    }
};
