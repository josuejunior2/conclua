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
        Schema::create('orientadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orientadorGeral_id');
            $table->foreign('orientadorGeral_id')->references('id')->on('orientadores_geral');
            $table->unsignedTinyInteger('disponibilidade')->default(0);
            $table->string('enderecoLattes', 38);
            $table->string('enderecoOrcid', 37);
            $table->string('subArea1', 60)->nullable();
            $table->string('subArea2', 60)->nullable();
            $table->string('subArea3', 60)->nullable();
            $table->string('areaPesquisa1', 60)->nullable();
            $table->string('areaPesquisa2', 60)->nullable();
            $table->string('areaPesquisa3', 60)->nullable();
            $table->string('areaPesquisa4', 60)->nullable();
            $table->string('areaPesquisa5', 60)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orientadores', function(BLueprint $table) {
            $table->dropForeign('orientadores_orientadorGeral_id_foreign');
            $table->dropColumn('orientadorGeral_id');
        });
        Schema::dropIfExists('orientadores');
    }
};
