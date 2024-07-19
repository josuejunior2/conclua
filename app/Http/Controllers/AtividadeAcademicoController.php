<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atividade;
use App\Models\Arquivo;
use App\Http\Requests\SubmissaoAtividadeRequest;
use App\Models\SubmissaoAtividade;

class AtividadeAcademicoController extends Controller
{
    public function show(Atividade $atividade)
    {
        return view('academico.atividade.show', ['atividade' => $atividade]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(SubmissaoAtividadeRequest $request)
    {
        $dados = $request->validated();
        $arquivos = $dados['arquivos_submissao'];
        $usuario = auth()->guard('web')->user();
        $submissao = SubmissaoAtividade::create($request->validated());
        $submissao->Atividade->update([
            'data_entrega' => $submissao->created_at
        ]);

        if ($request->hasFile('arquivos_submissao')) {
            $caminho = 'uploads/'.$submissao->Atividade->Orientacao->Semestre->periodoAno() . '/' . $submissao->Atividade->Orientacao->Orientador->diretorio() . '/' . $submissao->Atividade->Orientacao->Academico->diretorio() . '/recebido';
            foreach ($arquivos as $key => $arquivo) {
                Arquivo::create([
                    'nome' => $arquivo->getClientOriginalName(),
                    'atividade_id' => $submissao->Atividade->id,
                    'academico_id' => $submissao->Atividade->Orientacao->Academico->id,
                    'caminho' => $caminho,
                ]);
                $arquivo->move($caminho, $arquivo->getClientOriginalName());
            }
        }

        return redirect()->route('atividade.show', ['atividade' => $submissao->Atividade]);
    }
}
