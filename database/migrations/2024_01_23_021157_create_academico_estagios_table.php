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
            $table->tinyInteger('periodo')->comment('1 para 1º semestre, 2 para 2º semestre');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->date('limite_doc_estagio');
            $table->date('limite_orientacao');
            // $table->boolean('status')->default(0)->comment('true para ativo e false para inativo');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('academico_TCC', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academico_id')->required();
            $table->foreign('academico_id')->references('id')->on('academicos');
            $table->unsignedBigInteger('semestre_id')->required();
            $table->foreign('semestre_id')->references('id')->on('semestres');

            $table->text('tema', 10000);
            $table->text('problema', 10000);
            $table->text('objetivo_especifico', 10000);
            $table->text('objetivo_geral', 10000);
            $table->text('justificativa', 10000);
            $table->text('metodologia', 10000);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj', 18)->unique();
            $table->string('nome', 60);
            $table->string('supervisor', 60);
            $table->string('email', 40);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('academico_estagio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academico_id');
            $table->foreign('academico_id')->references('id')->on('academicos');
            $table->unsignedBigInteger('semestre_id')->required();
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->string('tema');
            $table->string('funcao');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semestres');

        Schema::dropIfExists('academico_estagio');

        Schema::dropIfExists('empresas');

        Schema::dropIfExists('academico_tcc');
    }
};
