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
        Schema::create('orientadoresgeral', function (Blueprint $table) {
            $table->id();
            $table->string('maspOrientador', 7)->unique();  //->primary();
            $table->string('nomeOrientador', 60);
            $table->string('emailOrientador', 40);
            $table->string('senhaOrientador', 64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orientadoresgeral');
    }
};
