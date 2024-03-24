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
        Schema::create('orientacoes', function (Blueprint $table) {
            $table->id();
            $table->date('data_vinculacao')->required();
            $table->unsignedBigInteger('academico_id')->required();
            $table->foreign('academico_id')->references('id')->on('academicos');
            $table->unsignedBigInteger('orientador_id')->required();
            $table->foreign('orientador_id')->references('id')->on('orientadores');
            $table->unsignedBigInteger('semestre_id')->required();
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->unsignedBigInteger('solicitacao_id')->required();
            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes');

            // $table->tinyInteger('modalidade')->nullable()->comment('0 -> Estágio  ;  1 -> TCC');
            $table->timestamps();
        });

        Schema::table('academicos_TCC', function (Blueprint $table) {
            $table->unsignedBigInteger('orientacao_id')->nullable();
            $table->foreign('orientacao_id')->references('id')->on('orientacoes');
        });

        Schema::table('academicos_estagio', function (Blueprint $table) {
            $table->unsignedBigInteger('orientacao_id')->nullable();
            $table->foreign('orientacao_id')->references('id')->on('orientacoes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orientacoes');
    }
};
