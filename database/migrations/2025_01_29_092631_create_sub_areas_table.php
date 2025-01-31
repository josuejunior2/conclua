<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SubArea;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_areas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });
        SubArea::create(['nome' => 'Organização']);
        SubArea::create(['nome' => 'Marketing']);
        SubArea::create(['nome' => 'Recursos Humanos']);
        SubArea::create(['nome' => 'Finanças']);
        SubArea::create(['nome' => 'Produção']);

        Schema::create('orientador_sub_area', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_area_id')->references('id')->on('sub_areas');
            $table->foreignId('orientador_id')->references('id')->on('orientadores');
            $table->timestamps();
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
