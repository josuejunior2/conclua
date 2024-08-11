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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();

            $table->foreignId('atividade_id')->references('id')->on('atividades');
            $table->unsignedBigInteger('comentario_id')->nullable();
            $table->foreign('comentario_id')->references('id')->on('comentarios');
            $table->text('texto', 10000);

            $table->unsignedBigInteger('academico_id')->nullable();
            $table->foreign('academico_id')->references('id')->on('academicos');
            $table->unsignedBigInteger('orientador_id')->nullable();
            $table->foreign('orientador_id')->references('id')->on('orientadores');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
