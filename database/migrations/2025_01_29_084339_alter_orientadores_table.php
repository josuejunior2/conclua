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
        Schema::table('orientadores', function (Blueprint $table) {
            $table->dropColumn('subArea1');
            $table->dropColumn('subArea2');
            $table->dropColumn('subArea3');
            $table->dropColumn('areaPesquisa1');
            $table->dropColumn('areaPesquisa2');
            $table->dropColumn('areaPesquisa3');
            $table->dropColumn('areaPesquisa4');
            $table->dropColumn('areaPesquisa5');
            
            $table->dropForeign(['formacao_id']);
            $table->dropForeign(['area_id']);
            $table->dropColumn('formacao_id');
            $table->dropColumn('area_id');
        });
        
        Schema::dropIfExists('areas');
        Schema::dropIfExists('formacoes');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
