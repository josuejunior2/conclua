<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atividade;
use App\Models\Arquivo;
use App\Http\Requests\SubmissaoAtividadeRequest;
use App\Models\SubmissaoAtividade;
use App\Http\Controllers\ArquivoController;
use App\Http\Requests\ArquivoSubmissaoRequest;

class AtividadeAcademicoController extends Controller
{
    protected $arquivoController;

    public function __construct(ArquivoController $arquivoController)
    {
        $this->arquivoController = $arquivoController;
    }

    public function show(Atividade $atividade)
    {
        if($atividade->Orientacao->Semestre->id != session('semestre_id')) return redirect()->route('home')->withErrors(['erro' => 'Erro: Atividade não pertence a esse semestre.']);
        return view('academico.atividade.show', ['atividade' => $atividade]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function storeSubmissao(SubmissaoAtividadeRequest $request)
    {
        $submissao = SubmissaoAtividade::create($request->validated());
        $submissao->Atividade->update([
            'data_entrega' => $submissao->created_at
        ]);
        
        if ($request->hasFile('arquivos_submissao')) {
            $requestArquivos = new ArquivoSubmissaoRequest($request->only(['arquivos_submissao']));
            $this->arquivoController->storeArquivoSubmissao($requestArquivos, $submissao);
        }

        return redirect()->route('academico.atividade.show', ['atividade' => $submissao->Atividade]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroySubmissao(SubmissaoAtividade $submissao)
    {
        $this->middleware('permission:excluir submissao');

        $atividade = $submissao->Atividade;
        $atividade->update([
            'data_entrega' => null
        ]);
        $atividade->save();

        foreach($atividade->arquivosSubmissao as $arquivo){
            unlink('./'.$arquivo->caminho.'/'.$arquivo->nome);
            $arquivo->forceDelete();
        }

        $submissao->forceDelete();
        return redirect()->route('academico.atividade.show', ['atividade' => $atividade])->with(['success' => 'Submissão excluída com sucesso.']);
    }
}
