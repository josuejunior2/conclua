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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArquivoController extends Controller
{ 
    /**
     * Remove the specified resource from storage.
     */
    public function downloadArquivo(DownloadArquivoAuxiliarRequest $request)
    {
        return Storage::disk('public')->download($request->validated()['caminho']);
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
        $caminho = 'uploads/'.$submissao->Atividade->Orientacao->Semestre->periodoAno() . '/' . $submissao->Atividade->Orientacao->Orientador->diretorio() . '/' . $submissao->Atividade->Orientacao->Academico->diretorio() . '/recebido';
        
        DB::transaction(function() use($caminho, $request, $submissao){   
            foreach ($request['arquivos_submissao'] as $key => $arquivo) {
                $nome = $this->setNomeArquivo($arquivo, $caminho);
                
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
        $caminho = 'uploads/'.$atividade->Orientacao->Semestre->periodoAno() . '/' . $atividade->Orientacao->Orientador->diretorio() . '/' . $atividade->Orientacao->Academico->diretorio() . '/enviado';
           
        DB::transaction(function() use($request, $caminho, $atividade){   
            foreach ($request['arquivos_aux'] as $key => $arquivo) {
                $nome =  $this->setNomeArquivo($arquivo, $caminho);

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
}
