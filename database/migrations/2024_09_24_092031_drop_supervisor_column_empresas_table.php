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
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('nome')->change();
            $table->string('email')->change();
            $table->dropColumn('supervisor');
        });

        Schema::table('academico_estagio', function (Blueprint $table) {
            $table->string('supervisor');
            $table->string('email_supervisor');
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
