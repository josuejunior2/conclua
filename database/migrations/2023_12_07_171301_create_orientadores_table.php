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
            $table->uuid('id')->primary();
            // $table->boolean('status')->default(0)->comment('true para ativo e false para inativo.');
            $table->string('masp', 7)->unique();  //->primary();
            $table->string('nome', 60);
            $table->string('email', 40);
            $table->string('password', 64);
            $table->unsignedTinyInteger('disponibilidade')->default(0);
            $table->string('enderecoLattes', 38)->unique()->nullable();
            $table->string('enderecoOrcid', 37)->unique()->nullable();
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
        Schema::dropIfExists('orientadores');
    }
};
