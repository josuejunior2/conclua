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
        Schema::table('formacoes', function (Blueprint $table) {
            $table->string('nome')->change();
        });
        Schema::table('areas', function (Blueprint $table) {
            $table->string('nome')->change();
        });
        Schema::table('academicos', function (Blueprint $table) {
            $table->string('matricula')->change();
        });
        Schema::table('orientadores', function (Blueprint $table) {
            $table->string('masp')->change();
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
