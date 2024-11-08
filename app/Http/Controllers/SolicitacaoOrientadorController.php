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
        $tcc = $estagio = null;
        if($solicitacao->AcademicoTCC) { $tcc = $solicitacao->AcademicoTCC; }
        if($solicitacao->AcademicoEstagio) { $estagio = $solicitacao->AcademicoEstagio; }

        return view('orientador.solicitacao.show', ['solicitacao' => $solicitacao, 'tcc' => $tcc, 'estagio' => $estagio]);
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
    { //acho que tem que colocar aqui a verificação se já tá orientado
        if($solicitacao->AcademicoTCC){
            if($solicitacao->AcademicoTCC->where('semestre_id', session('semestre_id'))->first()){
                $tcc = $solicitacao->AcademicoTCC->where('semestre_id', session('semestre_id'))->first();

                $orientacao = Orientacao::create([
                    'academico_id' => $solicitacao->Academico->id,
                    'orientador_id' => $solicitacao->Orientador->id,
                    'semestre_id' => $solicitacao->Semestre->id,
                    'solicitacao_id' => $solicitacao->id,
                    'academico_tcc_id' => $tcc->id
                ]);
                $tcc->update(['orientacao_id' => $orientacao->id]);
            }
        }
        if($solicitacao->AcademicoEstagio){
            if($solicitacao->AcademicoEstagio->where('semestre_id', session('semestre_id'))->first()){
                $estagio = $solicitacao->AcademicoEstagio->where('semestre_id', session('semestre_id'))->first();

                $orientacao = Orientacao::create([
                    'academico_id' => $solicitacao->Academico->id,
                    'orientador_id' => $solicitacao->Orientador->id,
                    'semestre_id' => $solicitacao->Semestre->id,
                    'solicitacao_id' => $solicitacao->id,
                    'academico_estagio_id' => $estagio->id
                ]);
                $estagio->update(['orientacao_id' => $orientacao->id]);
            }
        }
        $solicitacao->status = 1; // status de aprovada
        $solicitacao->save();

        $solicitacao->Orientador->disponibilidade -= 1;
        $solicitacao->Orientador->save();

        $outras = Solicitacao::where('academico_id', $solicitacao->Academico->id)->whereNot('id', $solicitacao->id);
        foreach($outras as $outra){
            $outra->status = 0;
            $outra->save();
        }

        return redirect()->route('admin.home');
    }

    /**
     * metodo post para o orientador rejeitar a solicitação
     */
    public function rejeitar_solicitacao(Solicitacao $solicitacao)
        {
            $solicitacao->status = 0;
            $solicitacao->save();

        return redirect()->route('admin.home');

    }
}
