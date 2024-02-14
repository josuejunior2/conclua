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
        Schema::create('semestres', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('ano');
            $table->tinyInteger('numero')->comment('1 para 1º semestre, 2 para 2º semestre');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->date('limite_doc_estagio');
            $table->date('limite_orientacao');
            $table->boolean('status')->default(0)->comment('true para ativo e false para inativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semestres');
    }
};
