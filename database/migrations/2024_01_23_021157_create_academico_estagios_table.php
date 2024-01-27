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
        Schema::create('academicos_TCC', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academico_id');
            $table->foreign('academico_id')->references('id')->on('academicos');
            $table->unsignedBigInteger('orientadorGeral_id')->nullable();
            $table->foreign('orientadorGeral_id')->references('id')->on('orientadores_geral');
            $table->string('tema', 60)->unique();
            $table->string('resumo', 750)->unique();
            $table->timestamps();
        });

        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj', 18)->unique();
            $table->string('name', 60);
            $table->string('supervisor', 60);
            $table->string('email', 40);
            $table->timestamps();
        });

        Schema::create('academicos_estagio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academico_id')->unique();
            $table->foreign('academico_id')->references('id')->on('academicos');
            $table->unsignedBigInteger('orientadorGeral_id')->nullable();
            $table->foreign('orientadorGeral_id')->references('id')->on('orientadores_geral');
            $table->string('tema', 60);
            $table->string('funcao', 40);
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academicos_estagio');

        Schema::dropIfExists('empresas');

        Schema::dropIfExists('academicos_TCC');
    }
};
