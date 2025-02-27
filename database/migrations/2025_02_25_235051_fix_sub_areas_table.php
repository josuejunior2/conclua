<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SubArea;
use App\Models\OrientadorSubArea;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(SubArea::where('nome', 'Organização')->get()->count() > 1){
            $subCerta = SubArea::where('nome', 'Organização')->first();
            $subErrada = SubArea::where('nome', 'Organização')->last();
            
            if ($subErrada && $subErrada->id !== $subCerta->id) {
                OrientadorSubArea::where('sub_area_id', $subErrada->id)
                    ->update(['sub_area_id' => $subCerta->id]);

                $subErrada->delete();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
