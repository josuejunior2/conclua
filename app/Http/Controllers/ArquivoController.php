<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DownloadArquivoAuxiliarRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\UploadedFile;
use App\Models\Atividade;
use App\Http\Requests\ArquivoSubmissaoRequest;
use App\Models\SubmissaoAtividade;
use App\Http\Requests\ArquivoAuxRequest;
use Illuminate\Support\Facades\Storage;

class ArquivoController extends Controller
{ 
    /**
     * Remove the specified resource from storage.
     */
    public function downloadArquivo(DownloadArquivoAuxiliarRequest $request)
    {
        $caminho = $request->validated()['caminho'];
        $filePath = public_path($caminho);
        return Response::download($filePath);
    }
    
    public function setNomeArquivo(UploadedFile $arquivo, string $caminho)
    {
        $nome =  basename($arquivo->getClientOriginalName(), '.'.$arquivo->getClientOriginalExtension());
        $extensao = basename($arquivo->getClientOriginalExtension());
        $nomeCompleto = $nome . "." . $extensao;
        
        if(Arquivo::where('caminho', $caminho)->where('nome', $nomeCompleto)->exists()){
            for($i = 1; Arquivo::where('nome', $nomeCompleto)->exists(); $i++){
                $nomeCompleto = basename($arquivo->getClientOriginalName(), '.'.$arquivo->getClientOriginalExtension()) . "(" . $i . ")" . "." . $extensao;
            }
        }
        return $nomeCompleto;
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function storeArquivoSubmissao(ArquivoSubmissaoRequest $request, SubmissaoAtividade $submissao)
    {
        // $dados = Atividade::create($request->validated());
        // $dados = $request->validated();
        // $arquivos = $request['arquivos_submissao'];

        $caminho = 'uploads/'.$submissao->Atividade->Orientacao->Semestre->periodoAno() . '/' . $submissao->Atividade->Orientacao->Orientador->diretorio() . '/' . $submissao->Atividade->Orientacao->Academico->diretorio() . '/recebido';
        
        foreach ($request['arquivos_submissao'] as $key => $arquivo) {
            $nome = $this->setNomeArquivo($arquivo, $caminho);
            
            Arquivo::create([
                'nome' => $nome,
                'submissao_atividade_id' => $submissao->id,
                'academico_id' => $submissao->Atividade->Orientacao->Academico->id,
                'caminho' => $caminho,
            ]);
            Storage::disk('public')->putFileAs($caminho, $arquivo, $nome);
        }

        return redirect()->back()->with(['success' => 'Arquivo adicionado na submissão com sucesso.']);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function storeArquivoAux(ArquivoAuxRequest $request, Atividade $atividade)
    {
        
        $caminho = 'uploads/'.$atividade->Orientacao->Semestre->periodoAno() . '/' . $atividade->Orientacao->Orientador->diretorio() . '/' . $atividade->Orientacao->Academico->diretorio() . '/enviado';
        foreach ($request['arquivos_aux'] as $key => $arquivo) {
            $nome =  $this->setNomeArquivo($arquivo, $caminho);

            Arquivo::create([
                'nome' => $nome,
                'atividade_id' => $atividade->id,
                'orientador_id' => $atividade->Orientacao->Orientador->id,
                'caminho' => $caminho,
            ]);
            Storage::disk('public')->putFileAs($caminho, $arquivo, $nome);
        }
        
        return redirect()->back()->with(['success' => 'Arquivo auxiliar adicionado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyArquivoSubmissao(Arquivo $arquivo)
    {
        Storage::disk('public')->delete($arquivo->caminho . '/' . $arquivo->nome);
        $arquivo->forceDelete();
        return redirect()->back()->with(['success' => 'Arquivo auxiliar excluído com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyArquivoAux(Arquivo $arquivo)
    {
        unlink('./'.$arquivo->caminho.'/'.$arquivo->nome);
        $arquivo->forceDelete();
        return redirect()->back()->with(['success' => 'Arquivo auxiliar excluído com sucesso.']);
    }
}