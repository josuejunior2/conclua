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
        Schema::create('submissao_atividade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('atividade_id')->required();
            $table->foreign('atividade_id')->references('id')->on('atividades');

            $table->string('arquivo')->nullable();
            $table->text('comentario', 10000)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissao_atividade');
    }
};
