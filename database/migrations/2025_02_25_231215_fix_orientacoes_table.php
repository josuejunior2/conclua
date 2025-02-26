<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use App\Models\{
    Orientacao,
    AcademicoEstagio,
    Semestre
};

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $orientacoes = Orientacao::all();
        foreach($orientacoes as $orientacao){
            if(!empty($orientacao->academico_estagio_id)){
                if(empty(AcademicoEstagio::where('semestre_id', Semestre::all()->last()->id)->where('academico_id', $orientacao->academico_id)->first()->id)){
                    continue;
                }
                $orientacao->update(['academico_estagio_id' => AcademicoEstagio::where('semestre_id', Semestre::all()->last()->id)->where('academico_id', $orientacao->academico_id)->first()->id]);
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
