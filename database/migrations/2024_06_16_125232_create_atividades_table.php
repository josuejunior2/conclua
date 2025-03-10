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
            $table->id();
            $table->unsignedBigInteger('orientacao_id')->required();
            $table->foreign('orientacao_id')->references('id')->on('orientacoes');

            $table->text('titulo', 256)->required();
            $table->text('descricao', 10000)->nullable();

            $table->dateTime('data_limite')->required();
            $table->dateTime('data_entrega')->nullable();

            $table->decimal('nota', 5, 2)->nullable();

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
