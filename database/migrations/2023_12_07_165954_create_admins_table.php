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
        Schema::create('admins', function (Blueprint $table) {
            // $table->id();
            $table->timestamps();
            $table->string('maspAdm', 7)->primary();
            $table->string('nomeAdm', 60);
            $table->string('emailAdm', 40);
            $table->string('senhaAdm', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
