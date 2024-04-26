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
        /**
         * A ideia aqui é fazer uma tabela para deixar o id do semestre e o do academico/orientador;
         * a finalidade é ver se N academicos/orientadores estão/estiveram com cadastros ativos em N semestre(s);
         * impreterivelmente, será ou do academico, ou do orientador;
         * como não se prevê qual que será cadastrado, estarão como nullable.
         */
        Schema::create('semestre_academico', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('academico_id')->required();
            $table->foreign('academico_id')->references('id')->on('academicos');
            $table->uuid('semestre_id')->required();
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->timestamps();
        });

        Schema::create('semestre_orientador', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('orientador_id')->required();
            $table->foreign('orientador_id')->references('id')->on('orientadores');
            $table->uuid('semestre_id')->required();
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->unsignedTinyInteger('disponibilidade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('semestre_academico', function(BLueprint $table) {
            $table->dropForeign('semestres_semestre_id_foreign');
            $table->dropColumn('semestre_id');
            $table->dropForeign('academicos_academico_id_foreign');
            $table->dropColumn('academico_id');
        });
        Schema::dropIfExists('semestre_academico');
        Schema::table('semestre_orientador', function(BLueprint $table) {
            $table->dropForeign('semestres_semestre_id_foreign');
            $table->dropColumn('semestre_id');
            $table->dropForeign('orientadores_orientador_id_foreign');
            $table->dropColumn('orientador_id');
        });
        Schema::dropIfExists('semestre_orientador');
    }
};
