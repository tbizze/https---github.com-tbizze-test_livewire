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
        Schema::create('movimentos', function (Blueprint $table) {
            $table->id();
            $table->date('dt_movimento');
            $table->decimal('valor');
            $table->enum('tipo', ['C', 'D']);
            $table->string('historico');
            $table->string('notas')->nullable();
            // Data de criação e de edição.
            $table->timestamps();
            // Recurso SoftDelete = excluir p/ lixeira.
            $table->softDeletes();
            // Chave estrangeira.
            $table->foreignId('movimento_grupo_id')->constrained();
            $table->foreignId('pgto_tipo_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove a chave estrangeira
        Schema::table('movimentos', function (Blueprint $table) {
            $table->dropForeign(['movimento_grupo_id']);
            $table->dropForeign(['pgto_tipo_id']);
        });

        Schema::dropIfExists('movimentos');
    }
};
