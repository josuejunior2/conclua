<?php

namespace App\Http\Controllers;

use App\Models\Orientador;
use App\Models\Solicitacao;
use App\Models\Academico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SolicitacaoRequest;

class SolicitacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Orientador $orientador, Academico $academico)
    {
        // dd($orientador);
        return view('academico.solicitacao.create', ['orientador' => $orientador, 'academico' => $academico]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolicitacaoRequest $request)
    {
        $solicitacao = Solicitacao::create($request->validated());
        // dd($solicitacao);
        return redirect()->route('academico.index')->with('success', 'Solicitação de orientação enviada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitacao $solicitacao)
    {
        $layouts = 'layouts.app';
        // dd($solicitacao);
        return view('academico.solicitacao.show', ['solicitacao' => $solicitacao, 'layouts' => $layouts]);
    }

    /**
     * Display the specified resource.
     */
    public function show_admin(Solicitacao $solicitacao)
    {
        $layouts = 'layouts.admin';
        // dd($solicitacao->Academico->);
        return view('academico.solicitacao.show', ['solicitacao' => $solicitacao, 'layouts' => $layouts]);
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

        return redirect()->route('solicitacao.show.web', ['solicitacao' => $solicitacao]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitacao $solicitacao)
    {
        $solicitacao->delete();
        return redirect()->route('academico.index');
    }

    /**
     * metodo post para o orientador aceitar a solicitação
     */
    public function aceitar(Solicitacao $solicitacao)
    {
        // criar um status pra solicitação? excluir ela ou não? é... tem que fazer um status mesmo
        if($solicitacao->Academico->AcademicoTCC){
            $solicitacao->Academico->AcademicoTCC->orientadorGeral_id = $solicitacao->orientadorGeral_id;
            $solicitacao->Academico->AcademicoTCC->save();
            return redirect()->route('orientadorgeral.index');
        } elseif($solicitacao->Academico->AcademicoEstagio){
            $solicitacao->Academico->AcademicoEstagio->orientadorGeral_id = $solicitacao->orientadorGeral_id;
            $solicitacao->Academico->AcademicoEstagio->save();
            return redirect()->route('orientadorgeral.index');
        } else{
            return back();
        }

    }

    /**
     * metodo post para o orientador rejeitar a solicitação
     */
    public function rejeitar($id)
    {
        // excluo a solicitação? status de rejeitada pra mostrar pro academico?

        $solicitacao->delete();
        return redirect()->route('orientadorgeral.index');

    }
}

