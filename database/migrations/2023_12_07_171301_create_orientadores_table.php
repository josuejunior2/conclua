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
            $table->string('masp', 7)->unique();
            $table->unsignedBigInteger('admin_id')->required();
            $table->foreign('admin_id')->references('id')->on('admins');

            $table->unsignedTinyInteger('disponibilidade')->nullable();
            $table->string('enderecoLattes', 38)->unique()->nullable();
            $table->string('enderecoOrcid', 37)->unique()->nullable();
            $table->string('subArea1')->nullable();
            $table->string('subArea2')->nullable();
            $table->string('subArea3')->nullable();
            $table->string('areaPesquisa1')->nullable();
            $table->string('areaPesquisa2')->nullable();
            $table->string('areaPesquisa3')->nullable();
            $table->string('areaPesquisa4')->nullable();
            $table->string('areaPesquisa5')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
