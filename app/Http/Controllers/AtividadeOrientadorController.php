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
        $orientacoes = auth()->guard('admin')->user()->Orientador->orientacoesNoSemestre();

        return view('orientador.atividade.create', ['orientacoes' => $orientacoes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AtividadeRequest $request)
    {
        $this->middleware('permission:criar atividade');
        
        $dados = $request->validated();
        $arquivos = $dados['arquivos_aux'];
        $atividade = Atividade::create($dados);

        if ($request->hasFile('arquivos_aux')) {
            $requestArquivos = new ArquivoAuxRequest($request->only(['arquivos_aux']));
            $this->arquivoController->storeArquivoAux($requestArquivos, $atividade);
        }
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

        $dados = $request->validated();
        $arquivos = $dados['arquivos_aux'];
        $usuario = auth()->guard('admin')->user();
        $atividade->update($dados);

        if ($request->hasFile('arquivos_aux')) {
        }

        return redirect()->route('orientador.atividade.show', ['atividade' => $atividade]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atividade $atividade)
    {
        if($atividade->SubmissaoAtividade) $atividade->SubmissaoAtividade->forceDelete();
        $atividade->forceDelete();
        return redirect()->route('orientador.atividade.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function avaliar(AvaliarAtividadeRequest $request, Atividade $atividade)
    {
        $atividade->update($request->validated());
        return redirect()->route('orientador.atividade.show', ['atividade' => $atividade]);
    }

}
