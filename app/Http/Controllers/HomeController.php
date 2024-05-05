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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $this->middleware('permission:permissao de escrita academico');
        $user = auth()->guard('web')->user();
        if($user->hasRole('Academico')){
            // -(só entra aqui depois de semestreAtivo)-PRIMEIRO CASO: O ACADEMICO AINDA NAO TEM ORIENTADOR

            // dd($this->middleware('semestre_ativo'));
            $academico = Academico::where('email', auth()->user()->email)->first();

            if($academico->Orientacao){
                if($academico->Orientacao->where('semestre_id', session('semestre_id'))->exists()){
                    if($academico->AcademicoTCC->where('semestre_id', session('semestre_id'))->exists()){
                        return view('academico.academicoTcc.home', ['academico' => $academico]);
                    } else if($academico->AcademicoEstagio->where('semestre_id', session('semestre_id'))->exists()){
                        return view('academico.academicoEstagio.home', ['academico' => $academico]);
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
                $orientadores = Orientador::where('disponibilidade', '>', 0)
                            ->whereNotIn('id', $OrientadoresEmSolicitacoesNulas)
                            ->get();

                $solicitacoesNoSemestre = Solicitacao::where('semestre_id', session('semestre_id'))->where('academico_id', $academico->id)->get();
                return view('academico.home', ['orientadores' => $orientadores, 'academico' => $academico, 'solicitacoes' => $solicitacoesNoSemestre]);
            }

        return $OrientadoresEmSolicitacoesNulas;
        }
    }
}
