<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Orientacao;
use App\Models\AcademicoEstagio;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $orientacoes = Orientacao::with('AcademicoEstagio')
        ->whereHas('AcademicoEstagio', function ($query) {
            $query->whereNull('orientacao_id'); // Filtra os que já têm um orientacao_id
        })
        ->get()->pluck('academico_estagio_id', 'id');

        foreach($orientacoes as $orientacao => $estagio) {
            AcademicoEstagio::find($estagio)->update(['orientacao_id' => $orientacao]);
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
