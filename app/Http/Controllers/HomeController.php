<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academico;
use App\Models\Orientador;
use App\Models\Solicitacao;
use App\Models\SemestreOrientador;
use App\Models\Semestre;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->guard('web')->user();
        // dd($user);
        if($user->hasRole('Academico')){
            // dd($user->check());
            // -(só entra aqui depois de semestreAtivo)-PRIMEIRO CASO: O ACADEMICO AINDA NAO TEM ORIENTADOR

            // dd($this->middleware('semestre_ativo'));
            $academico = Academico::where('user_id', auth()->user()->id)->first();
            $orientacaoNoSemestre = $academico->orientacoes->where('semestre_id', session('semestre_id'))->first();
            $atividades = $orientacaoNoSemestre->atividades ?? null;

            if(isset($orientacaoNoSemestre)){
                if(isset($orientacaoNoSemestre->academico_tcc_id)){
                    $academicoTCC = $academico->academicosTCC->where('semestre_id', session('semestre_id'))->first();

                    return view('academico.academicoTcc.home', ['academico' => $academico, 'tcc' => $academicoTCC, 'atividades' => $atividades]);
                } else if(isset($orientacaoNoSemestre->academico_estagio_id)){
                    $academicoEstagio = $academico->academicosEstagio->where('semestre_id', session('semestre_id'))->first();
                    return view('academico.academicoEstagio.home', ['academico' => $academico, 'estagio' => $academicoEstagio, 'atividades' => $atividades]);
                }
            }
            /** A ideia aqui é pegar os id's dos orientadores em solicitações nulas(não respondidas).
             *  Dessa forma, aparecerá para o academico apenas orientadores que não foram solicitados Ou os que foram solicitados,
             *  mas que rejeitaram a solicitação (status == 0), e assim o academico pode pedir denovo
             */
            $OrientadoresEmSolicitacoesNulas = [];
            foreach($academico->solicitacoes->where('semestre_id', session('semestre_id')) as $key => $solicitacao){
                if(is_null($solicitacao->status)){
                    $OrientadoresEmSolicitacoesNulas[] = $solicitacao->getAttribute('orientador_id');
                }
            }
            $orientadores = Orientador::whereNotIn('id', $OrientadoresEmSolicitacoesNulas) // where('disponibilidade', '>', 0)
                        ->get();

            $solicitacoesNoSemestre = Solicitacao::where('semestre_id', session('semestre_id'))->where('academico_id', $academico->id)->get();

            return view('academico.home', ['orientadores' => $orientadores, 'academico' => $academico, 'solicitacoes' => $solicitacoesNoSemestre]);
        }

        return abort(403, "acesso não autorizado");

    }
}
