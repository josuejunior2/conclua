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
        $this->middleware('permission:TesteAcad');
        $user = auth()->user();
        if($user->hasRole('Academico')){
            // // -(só entra aqui depois de semestreAtivo)-PRIMEIRO CASO: O ACADEMICO AINDA NAO TEM ORIENTADOR

            // // dd($this->middleware('semestre_ativo'));
            // $academico = Academico::where('email', auth()->user()->email)->first();

            // if($academico->Orientacao->where('semestre_id', session('semestre_id'))){
            //     if($academico->Orientacao->where('semestre_id', app('semestreAtivo')->id)->exists()){
            //         if($academico->AcademicoTCC->where('semestre_id', app('semestreAtivo')->id)->exists()){
            //             return view('academico.academicoTcc.home');
            //         } else if($academico->AcademicoEstagio->where('semestre_id', app('semestreAtivo')->id)->exists()){
            //             return view('academico.academicoEstagio.home');
            //         }
            //     }
            // } else{

            //     /** A ideia aqui é pegar os id's dos orientadores em solicitações nulas(não respondidas).
            //      *  Dessa forma, aparecerá para o academico apenas orientadores que não foram solicitados Ou os que foram solicitados,
            //      *  mas que rejeitaram a solicitação (status == 0), e assim o academico pode pedir denovo
            //      */
            //     $OrientadoresEmSolicitacoesNulas = [];
            //     foreach($academico->solicitacoes as $key => $solicitacao){
            //         if(is_null($solicitacao->status)){
            //             $OrientadoresEmSolicitacoesNulas[] = $solicitacao->getAttribute('orientador_id');
            //         }
            //     }

            //     $orientadoresComDisponibilidade = app('semestreAtivo')->orientadores->filter(function ($orientador) use ($OrientadoresEmSolicitacoesNulas) {
            //         // Verifique se há uma instância de SemestreOrientador para o orientador atual
            //         $semestreOrientador = SemestreOrientador::where('semestre_id', optional(app('semestreAtivo'))->id)
            //             ->where('orientador_id', $orientador->id)
            //             ->first();

            //         // Se a instância existir, a disponibilidade for maior que 0 e o ID não estiver em $OrientadoresEmSolicitacoesNulas, retorne true
            //         return $semestreOrientador && $semestreOrientador->disponibilidade > 0 && !in_array($orientador->id, $OrientadoresEmSolicitacoesNulas);
            //     });

                return view('academico.home'); //, ['orientadores' => $orientadoresComDisponibilidade, 'academico' => $academico]);
            }
        
        return "deu rui,";
    }
}
