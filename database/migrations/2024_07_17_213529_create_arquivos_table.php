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
        Schema::create('arquivos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('atividade_id')->required();
            $table->foreign('atividade_id')->references('id')->on('atividades');
            $table->string('nome')->required();
            $table->string('caminho')->required();

            $table->uuid('academico_id')->nullable();
            $table->foreign('academico_id')->references('id')->on('academicos');
            $table->uuid('orientador_id')->nullable();
            $table->foreign('orientador_id')->references('id')->on('orientadores');
            

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquivos');
    }
};
