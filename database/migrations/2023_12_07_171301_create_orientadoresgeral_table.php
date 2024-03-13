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
        Schema::create('orientadores_geral', function (Blueprint $table) {
            $table->id();
            $table->string('masp', 7)->unique();  //->primary();
            $table->string('nome', 60);
            $table->string('email', 40);
            $table->string('password', 64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orientadores_geral');
    }
};
