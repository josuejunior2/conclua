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
        Schema::create('academicos', function (Blueprint $table) {
            // $table->id();
            $table->timestamps();
            $table->string('matriculaAcademico', 9)->primary();
            $table->string('nomeAcademico', 60);
            $table->string('emailAcademico', 40);
            $table->string('senhaAcademico', 64);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academicos');
    }
};
