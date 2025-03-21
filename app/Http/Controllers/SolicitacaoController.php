<?php

namespace App\Http\Controllers;

use App\Models\Orientador;
use App\Models\Solicitacao;
use App\Models\Academico;
use App\Models\Semestre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SolicitacaoRequest;
use Illuminate\Support\Facades\Log;

class SolicitacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:visualizar solicitacao')->only(['show']);
        $this->middleware('permission:criar solicitacao')->only(['create', 'store']);
        $this->middleware('permission:editar solicitacao')->only(['edit', 'update']);
        $this->middleware('permission:excluir solicitacao')->only(['destroy']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Orientador $orientador, Academico $academico)
    {
        $tcc = $academico->academicosTCC->where('academico_id', $academico->id)->where('semestre_id', session('semestre_id'))->first();
        $estagio = $academico->academicosEstagio->where('academico_id', $academico->id)->where('semestre_id', session('semestre_id'))->first();

        if(isset($tcc)){
            return view('academico.solicitacao.create', ['orientador' => $orientador, 'academico' => $academico, 'tcc' => $tcc]);
        } else if($estagio){
            return view('academico.solicitacao.create', ['orientador' => $orientador, 'academico' => $academico, 'estagio' => $estagio]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolicitacaoRequest $request)
    {
        $solicitacao = Solicitacao::create($request->validated());
        Log::channel('main')->info('Solicitacao cadastrado.', ['data' => [$solicitacao], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        // dd($solicitacao);
        return redirect()->route('home')->with('success', 'Solicitação de orientação enviada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitacao $solicitacao)
    {
        return view('academico.solicitacao.show', ['solicitacao' => $solicitacao]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitacao $solicitacao)
    {
        return view('academico.solicitacao.edit', ['solicitacao' => $solicitacao]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SolicitacaoRequest $request, Solicitacao $solicitacao)
    {
        $solicitacao->update($request->validated());
        Log::channel('main')->info('Solicitacao editada.', ['data' => [$solicitacao], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        if($request->input('status') == 0){
            return redirect()->route('home');
        }
        return redirect()->route('solicitacao.show.web', ['solicitacao' => $solicitacao]); // pro caso do academico dar update
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitacao $solicitacao)
    {
        $solicitacao->delete();
        Log::channel('main')->info('Solicitacao excluida.', ['data' => [$solicitacao], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->route('home');
    }

}

