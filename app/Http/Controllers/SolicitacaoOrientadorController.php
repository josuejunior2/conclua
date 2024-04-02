<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solicitacao;
use App\Models\Orientacao;

class SolicitacaoOrientadorController extends Controller
{

    /**
     * Mostra para o orientador ou admin.
     */
    public function show(Solicitacao $solicitacao)
    {
        return view('orientador.show-solicitacao', ['solicitacao' => $solicitacao]);
    }

    /**
     * Metodo post para o orientador aceitar a solicitação
     * Aqui será feito:
     *      o store do obj Orientacao
     *      atualizacao do status da solicitacao para true
     *      atualizacao do status das outras solicitações para false
     *      relacões entre obj's
     */
    public function aceitar_solicitacao(Solicitacao $solicitacao)
    {
        $orientacao = Orientacao::create([
            'academico_id' => $solicitacao->Academico->id,
            'orientador_id' => $solicitacao->Orientador->id,
            'semestre_id' => $solicitacao->Semestre->id,
            'solicitacao_id' => $solicitacao->id,
            'data_vinculacao' => now(),
        ]);

        $solicitacao->status = 1; // status de aprovada
        $solicitacao->save();

        $outras = Solicitacao::where('academico_id', $solicitacao->Academico->id)->whereNot('id', $solicitacao->id);
        foreach($outras as $outra){
            $outra->status = 0;
            $outra->save();
        }

        return redirect()->route('home');
    }

    /**
     * metodo post para o orientador rejeitar a solicitação
     */
    public function rejeitar_solicitacao(Solicitacao $solicitacao)
        {
            $solicitacao->status = 0;
            $solicitacao->save();

        return redirect()->route('home');

    }
}
