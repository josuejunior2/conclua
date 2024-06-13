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
            $table->uuid('id')->primary();
            $table->uuid('academico_id')->required();
            $table->foreign('academico_id')->references('id')->on('academicos');

            $table->uuid('academico_tcc_id')->nullable();
            $table->foreign('academico_tcc_id')->references('id')->on('academico_tcc');

            $table->uuid('academico_estagio_id')->nullable();
            $table->foreign('academico_estagio_id')->references('id')->on('academico_estagio');

            $table->uuid('orientador_id')->required();
            $table->foreign('orientador_id')->references('id')->on('orientadores');
            $table->uuid('semestre_id')->required();
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->uuid('solicitacao_id')->required();
            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes');

            // $table->tinyInteger('modalidade')->nullable()->comment('0 -> Estágio  ;  1 -> TCC');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('academico_tcc', function (Blueprint $table) {
            $table->uuid('orientacao_id')->nullable();
            $table->foreign('orientacao_id')->references('id')->on('orientacoes');
        });

        Schema::table('academico_estagio', function (Blueprint $table) {
            $table->uuid('orientacao_id')->nullable();
            $table->foreign('orientacao_id')->references('id')->on('orientacoes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orientacoes', function(BLueprint $table) {
            $table->dropForeign('solicitacoes_solicitacao_id_foreign');
            $table->dropColumn('solicitacao_id');
            $table->dropForeign('semestres_semestre_id_foreign');
            $table->dropColumn('semestre_id');
            $table->dropForeign('academicos_academico_id_foreign');
            $table->dropColumn('academico_id');
            $table->dropForeign('orientadores_orientador_id_foreign');
            $table->dropColumn('orientador_id');
        });
        Schema::dropIfExists('orientacoes');
    }
};
