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
        Schema::create('formacoes', function (Blueprint $table) {
            $table->id();
            $table->string('formacao', 40);
            $table->timestamps();
        });

        Schema::table('orientadores_geral', function(BLueprint $table) {
            $table->unsignedBigInteger('formacao_id')->nullable()->after('area_id');
            $table->foreign('formacao_id')->references('id')->on('formacoes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orientadores_geral', function(BLueprint $table) {
            $table->dropForeign('orientadores_geral_formacao_id_foreign');
            $table->dropColumn('formacao_id');
        });

        Schema::dropIfExists('formacoes');
    }
};
