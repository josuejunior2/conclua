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
        Schema::create('modelos_documento', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao', 10000)->nullable();
            $table->string('modalidade')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('arquivos', function (Blueprint $table) {
            $table->unsignedBigInteger('modelo_documento_id')->default(null)->nullable()->after('atividade_id');
            $table->foreign('modelo_documento_id')->references('id')->on('modelos_documento');
            $table->unsignedBigInteger('orientacao_id')->default(null)->nullable()->after('modelo_documento_id');
            $table->foreign('orientacao_id')->references('id')->on('orientacoes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
