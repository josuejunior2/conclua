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
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academico_id')->required();
            $table->foreign('academico_id')->references('id')->on('academicos');
            $table->unsignedBigInteger('orientadorGeral_id')->required();
            $table->foreign('orientadorGeral_id')->references('id')->on('orientadores_geral');
            $table->boolean('status')->default(0)->comment('true para aceito e false para rejeitado');
            $table->string('mensagem', 255)->nullable(); // colocar um comentário? 'me aceita ai professor pfv vc é muito legal cara'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitacoes', function(BLueprint $table) {
            $table->dropForeign('academicos_academico_id_foreign');
            $table->dropColumn('academico_id');
            $table->dropForeign('orientadores_orientadorGeral_id_foreign');
            $table->dropColumn('orientadorGeral_id');
        });
        Schema::dropIfExists('solicitacoes');
    }
};
