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
use App\Http\Requests\ArquivoModeloRequest;
use App\Http\Requests\ArquivoDocumentacaoRequest;
use App\Http\Requests\ArquivoStatusDocumentacaoRequest;
use App\Models\SubmissaoAtividade;
use App\Http\Requests\ArquivoAuxRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Semestre;
use App\Models\ModeloDocumento;
use App\Models\Orientacao;
use Illuminate\Support\Str;

class ArquivoController extends Controller
{ 
    /**
     * Remove the specified resource from storage.
     */
    public function downloadArquivo(DownloadArquivoAuxiliarRequest $request)
    {
        return Storage::disk('public')->download($request->validated()['caminho']);
    }
    
    public function setNomeArquivo(UploadedFile $arquivo)
    {
        $extensao = $arquivo->getClientOriginalExtension();
        $nomeSemExtensao = pathinfo($arquivo->getClientOriginalName(), PATHINFO_FILENAME);
        
        $nome = Str::slug($nomeSemExtensao) . "-" . now()->format('YmdHis') . "." . $extensao;

        return $nome;
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function storeArquivoSubmissao(ArquivoSubmissaoRequest $request, SubmissaoAtividade $submissao)
    {
        $caminho = 'uploads/'.$submissao->Atividade->Orientacao->Semestre->periodoAno() . '/' . $submissao->Atividade->Orientacao->Orientador->diretorio() . '/' . $submissao->Atividade->Orientacao->Academico->diretorio() . '/submissao';
        
        DB::transaction(function() use($caminho, $request, $submissao){   
            foreach ($request['arquivos_submissao'] as $key => $arquivo) {
                $nome = $this->setNomeArquivo($arquivo);
                
                Arquivo::create([
                    'nome' => $nome,
                    'submissao_atividade_id' => $submissao->id,
                    'academico_id' => $submissao->Atividade->Orientacao->Academico->id,
                    'caminho' => $caminho,
                ]);
                Storage::disk('public')->putFileAs($caminho, $arquivo, $nome);
                Log::channel('main')->info('Arquivo submissão armazenado.', ['data' => [$caminho, $arquivo, $nome], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
            }
        });

        return redirect()->back()->with(['success' => 'Arquivo adicionado na submissão com sucesso.']);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function storeArquivoAux(ArquivoAuxRequest $request, Atividade $atividade)
    {
        $caminho = 'uploads/'.$atividade->Orientacao->Semestre->periodoAno() . '/' . $atividade->Orientacao->Orientador->diretorio() . '/' . $atividade->Orientacao->Academico->diretorio() . '/auxiliar';
           
        DB::transaction(function() use($request, $caminho, $atividade){   
            foreach ($request['arquivos_aux'] as $key => $arquivo) {
                $nome =  $this->setNomeArquivo($arquivo);

                Arquivo::create([
                    'nome' => $nome,
                    'atividade_id' => $atividade->id,
                    'orientador_id' => $atividade->Orientacao->Orientador->id,
                    'caminho' => $caminho,
                ]);
                Storage::disk('public')->putFileAs($caminho, $arquivo, $nome);
                Log::channel('main')->info('Arquivo auxiliar armazenado.', ['data' => [$caminho, $arquivo, $nome], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
            }        
        });
        
        return redirect()->back()->with(['success' => 'Arquivo auxiliar adicionado com sucesso.']);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function storeArquivoModelo(ArquivoModeloRequest $request, ModeloDocumento $modelo)
    {
        $semestre = Semestre::find(session('semestre_id'));
        $caminho = 'uploads/modelo_documento/'.$semestre->periodoAno();

        DB::transaction(function() use($request, $caminho, $modelo){
            // dd($request->all());
            foreach ($request->input('arquivos') as $arquivo) {
                $nome =  $this->setNomeArquivo($arquivo);

                Arquivo::create([
                    'nome' => $nome,
                    'modelo_documento_id' => $modelo->id,
                    'caminho' => $caminho,
                ]);
                Storage::disk('public')->putFileAs($caminho, $arquivo, $nome);
                Log::channel('main')->info('Arquivo modelo armazenado.', ['data' => [$caminho, $arquivo, $nome], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
            }        
        });
        
        return redirect()->back()->with(['success' => 'Arquivo modelo adicionado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyArquivoSubmissao(Arquivo $arquivo)
    {        
        DB::transaction(function() use($arquivo){   
            Storage::disk('public')->delete($arquivo->caminho . '/' . $arquivo->nome);
            $arquivo->delete();      
            Log::channel('main')->info('Arquivo submissão excluído.', ['data' => [$arquivo->caminho, $arquivo], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);  
        });
        return redirect()->back()->with(['success' => 'Arquivo da submissão excluído com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyArquivoAux(Arquivo $arquivo)
    {
        DB::transaction(function() use($arquivo){ 
            Storage::disk('public')->delete($arquivo->caminho . '/' . $arquivo->nome);
            $arquivo->delete();  
            Log::channel('main')->info('Arquivo auxiliar excluído.', ['data' => [$arquivo->caminho, $arquivo], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]); 
        });
        return redirect()->back()->with(['success' => 'Arquivo auxiliar excluído com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyArquivoModelo(Arquivo $arquivo)
    {
        DB::transaction(function() use($arquivo){ 
            Storage::disk('public')->delete($arquivo->caminho . '/' . $arquivo->nome);
            $arquivo->forceDelete();  
            Log::channel('main')->info('Arquivo de modelo excluído.', ['data' => [$arquivo->caminho, $arquivo], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]); 
        });
        return redirect()->back()->with(['success' => 'Arquivo de modelo excluído com sucesso.']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storeArquivoDocumentacao(ArquivoDocumentacaoRequest $request, Orientacao $orientacao)
    {
        $semestre = Semestre::find(session('semestre_id'));
        $caminho = 'uploads/'.$orientacao->Semestre->periodoAno() . '/' . $orientacao->Orientador->diretorio() . '/' . $orientacao->Academico->diretorio() . '/documentacao';

        DB::transaction(function() use($request, $caminho, $orientacao){
            $dados = $request->validated();
            // dd($dados);
            foreach ($dados['arquivos_documentacao'] as $arquivo) {
                $nome =  $this->setNomeArquivo($arquivo);

                Arquivo::create([
                    'nome' => $nome,
                    'modelo_documento_id' => $request->modelo_documento_id,
                    'orientacao_id' => $orientacao->id,
                    'caminho' => $caminho,
                ]);
                Storage::disk('public')->putFileAs($caminho, $arquivo, $nome);
                Log::channel('main')->info('Arquivo de documentação armazenado.', ['data' => [$caminho, $arquivo, $nome, $orientacao], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
            }        
        });
        
        return redirect()->back()->with(['success' => 'Arquivo documentação adicionado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyArquivoDocumentacao(Arquivo $arquivo)
    {
        DB::transaction(function() use($arquivo){ 
            Storage::disk('public')->delete($arquivo->caminho . '/' . $arquivo->nome);
            $arquivo->forceDelete();  
            Log::channel('main')->info('Arquivo de documentação excluído.', ['data' => [$arquivo->caminho, $arquivo], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]); 
        });
        return redirect()->back()->with(['success' => 'Arquivo de documentação excluído com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function statusDocumentacao(ArquivoStatusDocumentacaoRequest $request, Arquivo $arquivo)
    {
        $dados = $request->validated();
        DB::transaction(function() use($arquivo, $dados){
            $arquivo->update($dados);
            // dd($arquivo);
            Log::channel('main')->info('Arquivo de documentação avaliado.', ['data' => [$arquivo->caminho, $arquivo], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]); 
        });
        return redirect()->back()->with(['success' => 'Documentação avaliada com sucesso.']);
    }
}
