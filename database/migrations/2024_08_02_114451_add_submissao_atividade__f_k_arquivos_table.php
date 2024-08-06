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
        Schema::table('arquivos', function (Blueprint $table) {
            $table->unsignedBigInteger('atividade_id')->nullable()->change();

            $table->unsignedBigInteger('submissao_atividade_id')->nullable()->after('atividade_id');
            $table->foreign('submissao_atividade_id')->references('id')->on('submissao_atividade');
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
