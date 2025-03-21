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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 40);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('orientadores', function(BLueprint $table) {
            $table->unsignedBigInteger('area_id')->nullable()->after('admin_id');
            $table->foreign('area_id')->references('id')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orientadores', function(BLueprint $table) {
            $table->dropForeign('orientadores_area_id_foreign');
            $table->dropColumn('area_id');
        });

        Schema::dropIfExists('areas');
    }
};
