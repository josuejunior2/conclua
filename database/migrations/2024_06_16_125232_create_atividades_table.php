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
        Schema::create('atividades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('orientacao_id')->required();
            $table->foreign('orientacao_id')->references('id')->on('orientacoes');

            $table->text('titulo', 256)->required();
            $table->text('descricao', 10000)->nullable();

            $table->date('data_limite')->required();
            $table->date('data_entrega')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atividades');
    }
};
