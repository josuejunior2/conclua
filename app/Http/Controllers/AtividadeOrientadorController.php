<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\Arquivo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\AtividadeRequest;
use App\Http\Requests\AvaliarAtividadeRequest;
use App\Http\Requests\ArquivoAuxRequest;
use App\Http\Controllers\ArquivoController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AtividadeOrientadorController extends Controller
{
    protected $arquivoController;

    public function __construct(ArquivoController $arquivoController)
    {
        $this->arquivoController = $arquivoController;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atividades = Atividade::whereIn('orientacao_id', auth()->guard('admin')->user()->Orientador->orientacoesNoSemestre()->pluck('id'))->get();
        return view('orientador.atividade.index', ['atividades' => $atividades]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->middleware('permission:criar atividade');
        $orientacoes = auth()->guard('admin')->user()->Orientador->orientacoesEmAndamento();

        return view('orientador.atividade.create', ['orientacoes' => $orientacoes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AtividadeRequest $request)
    {
        $this->middleware('permission:criar atividade');
        
        DB::transaction(function() use($request, &$atividade){   
            $dados = $request->validated();
            $atividade = Atividade::create($dados);

            if ($request->hasFile('arquivos_aux')) {
                $requestArquivos = new ArquivoAuxRequest($request->only(['arquivos_aux']));
                $this->arquivoController->storeArquivoAux($requestArquivos, $atividade);
            }
        });
        return redirect()->route('orientador.atividade.show', ['atividade' => $atividade]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Atividade $atividade)
    {
        return view('orientador.atividade.show', ['atividade' => $atividade]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atividade $atividade)
    {
        $this->middleware('permission:editar atividade');
        $orientacoes = auth()->guard('admin')->user()->Orientador->orientacoesNoSemestre();

        return view('orientador.atividade.edit', ['atividade' => $atividade, 'orientacoes' => $orientacoes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtividadeRequest $request, Atividade $atividade)
    {
        $this->middleware('permission:editar atividade');

        DB::transaction(function() use($request, &$atividade){ 
            $dados = $request->validated();
            $atividade->update($dados);

            if ($request->hasFile('arquivos_aux')) {
                $requestArquivos = new ArquivoAuxRequest($request->only(['arquivos_aux']));
                $this->arquivoController->storeArquivoAux($requestArquivos, $atividade);
            }
        });

        return redirect()->route('orientador.atividade.show', ['atividade' => $atividade]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atividade $atividade)
    {
        $this->middleware('permission:excluir atividade');

        DB::transaction(function() use($atividade){   
            $arquivos = $atividade->arquivosAuxiliares->merge($atividade->arquivosSubmissao);

            foreach($arquivos as $arquivo){
                $this->arquivoController->destroyArquivoAux($arquivo);
            }
            
            if(!empty($atividade->SubmissaoAtividade)) $atividade->SubmissaoAtividade->delete();
            $atividade->delete();
        });
        return redirect()->route('orientador.atividade.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function avaliar(AvaliarAtividadeRequest $request, Atividade $atividade)
    {
        $this->middleware('permission:avaliar atividade');

        DB::transaction(function() use($request, &$atividade){   
            $atividade->update($request->validated());
        });
        return redirect()->route('orientador.atividade.show', ['atividade' => $atividade]);
    }

}
