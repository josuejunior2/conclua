<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academico;
use App\Models\Orientador;
use App\Models\Solicitacao;
use App\Models\ModeloDocumento;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
                $comentarios = [];
                $statusDocumentacoesSubmetidas = [];
                $prazoDocumentacoes = [];
                foreach($atividades as $atividade){
                    $comentarios[] = $atividade->comentariosOrientador()->with('Orientador.Admin')->get()->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'tipo' => 'comentario',
                            'rota' => 'academico.atividade.show',
                            'avatar' => $item->Orientador->avatar(),
                            'dado_rota' => $item->atividade_id,
                            'key_dado_rota' => 'atividade',
                            'nome_orientador' => Str::words($item->Orientador->Admin->nome, 2, ""),
                            'msg' => " comentou em ",
                            'titulo' => $item->Atividade->titulo,
                            'created_at' => $item->created_at,
                        ];
                    })->toArray();
                }
                $statusDocumentacoesSubmetidas[] = $orientacaoNoSemestre->getArquivosDocumentacao()->whereNotNull('status_documentacao')->whereColumn('created_at', '!=', 'updated_at')->with('Orientacao.Academico.User', 'ModeloDocumento')->get()->map(function ($item) {
                    $status = $item->status_documentacao ? "APROVOU" : "REPROVOU";
                    return [
                        'id' => $item->id,
                        'tipo' => 'documentacao',
                        'rota' => 'academico.modelo_documento.index',
                        'avatar' => $item->Orientacao->Orientador->avatar(),
                        'nome_orientador' => Str::words($item->Orientacao->Orientador->Admin->nome, 2, ""),
                        'msg' => " " . $status . " sua documentação ",
                        'titulo' => $item->ModeloDocumento->nome,
                        'created_at' => $item->updated_at,
                    ];
                })->toArray();

                $modalidadeModelo = $orientacaoNoSemestre->academico_tcc_id ? "tcc" : "estagio";
                $prazoDocumentacoes[] = ModeloDocumento::where('modalidade', $modalidadeModelo)->whereBetween('data_limite', [now(), now()->addDays(7)])->whereNotIn('id', $orientacaoNoSemestre->getArquivosDocumentacao()->get()->pluck('modelo_documento_id')->toArray())->get()->map(function ($item) {
                    $diasFaltantes = Carbon::now()->diffInDays(Carbon::parse($item->data_limite));
                    return [
                        'id' => $item->id,
                        'tipo' => 'documentacao',
                        'rota' => 'academico.modelo_documento.index',
                        'nome_orientador' => 'Atenção:',
                        'msg' => " faltam " . $diasFaltantes . " dias para entregar ",
                        'titulo' => $item->nome,
                        'created_at' => $item->data_limite,
                    ];
                })->toArray();
                $news = collect(array_merge($statusDocumentacoesSubmetidas[0], $comentarios[0], $prazoDocumentacoes[0]))->filter()->sortByDesc('created_at')->toArray();

                if(isset($orientacaoNoSemestre->academico_tcc_id)){
                    $academicoTCC = $academico->academicosTCC->where('semestre_id', session('semestre_id'))->first();

                    return view('academico.academicoTcc.home', ['academico' => $academico, 'tcc' => $academicoTCC, 'atividades' => $atividades, 'news' => $news]);
                } else if(isset($orientacaoNoSemestre->academico_estagio_id)){
                    $academicoEstagio = $academico->academicosEstagio->where('semestre_id', session('semestre_id'))->first();
                    return view('academico.academicoEstagio.home', ['academico' => $academico, 'estagio' => $academicoEstagio, 'atividades' => $atividades, 'news' => $news]);
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
