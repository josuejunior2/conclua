<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orientador;
use App\Models\Orientacao;
use App\Models\Solicitacao;
use App\Models\Semestre;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(session('semestre_id'));
        $admin = auth()->guard('admin')->user();
        if($admin->hasRole('Orientador')){
            $orientador = $admin->Orientador;
            $solicitacoes = Solicitacao::where('orientador_id', $orientador->id)->where('status', null)->get();
            $orientacoes = $orientador->orientacoes->where('semestre_id', session('semestre_id'));

            $submissoes = [];
            $comentarios = [];
            $documentacoes = [];
            foreach($orientacoes as $orientacao){
                foreach($orientacao->atividades as $atividade){
                    $submissoes[] = $atividade->SubmissaoAtividade()->with('Atividade.Orientacao.Academico.User')->get()->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'tipo' => 'submissao',
                            'rota' => 'orientador.atividade.show',
                            'avatar' => $item->Atividade->Orientacao->Academico->avatar(),
                            'dado_rota' => $item->atividade_id,
                            'key_dado_rota' => 'atividade',
                            'nome_academico' => Str::words($item->Atividade->Orientacao->Academico->User->nome, 3, ""),
                            'msg' => " submeteu à atividade ",
                            'titulo' => $item->Atividade->titulo,
                            'created_at' => $item->created_at,
                        ];
                    })->collapse()->toArray();
                    $comentarios[] = $atividade->comentariosAcademico()->with('Academico.User')->get()->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'tipo' => 'comentario',
                            'rota' => 'orientador.atividade.show',
                            'avatar' => $item->Academico->avatar(),
                            'dado_rota' => $item->atividade_id,
                            'key_dado_rota' => 'atividade',
                            'nome_academico' => Str::words($item->Academico->User->nome, 3, ""),
                            'msg' => " comentou em ",
                            'titulo' => $item->Atividade->titulo,
                            'created_at' => $item->created_at,
                        ];
                    })->collapse()->toArray();
                }
                $documentacoes[] = $orientacao->getArquivosDocumentacao()->with('Orientacao.Academico.User', 'ModeloDocumento')->get()->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'tipo' => 'documentacao',
                        'rota' => 'orientador.academico.show',
                        'avatar' => $item->Orientacao->Academico->avatar(),
                        'dado_rota' => $item->Orientacao->academico_id,
                        'key_dado_rota' => 'academico',
                        'nome_academico' => Str::words($item->Orientacao->Academico->User->nome, 3, ""),
                        'msg' => " entregou a documentação ",
                        'titulo' => $item->ModeloDocumento->nome,
                        'created_at' => $item->created_at,
                    ];
                })->collapse()->toArray();
            }
            $news = collect(array_merge($submissoes, $comentarios, $documentacoes))->filter()->sortByDesc('created_at')->toArray();
            // dd($news);

            return view('orientador.home', ['orientador' => $orientador, 'solicitacoes' => $solicitacoes, 'orientacoes' => $orientacoes, 'news' => $news]);
        } elseif($admin->roles->where('guard_name', 'admin')){
            $semestres = Semestre::all();
            return view('admin.home', ['semestres' => $semestres, 'solicitacoes' => Solicitacao::getSolicitacoesAtuaisView(), 'orientadores' => Orientador::withoutTrashed()->get(), 'orientacoes' => Orientacao::getSolicitacoesAtuaisView()]);
        } else{
            return abort(403, 'Você não está autenticado ao sistema.');
        }
    }
}
