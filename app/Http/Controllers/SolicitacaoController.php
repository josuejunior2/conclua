<?php

namespace App\Http\Controllers;

use App\Models\Orientador;
use App\Models\Solicitacao;
use App\Models\Academico;
use App\Models\Semestre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SolicitacaoRequest;

class SolicitacaoController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if (auth()->guard('web')->check() || auth()->guard('admin')->check()) {
                return $next($request);
            }

            abort(403, 'Não autorizado.');
        });
    }
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
        $semestre = Semestre::where('status', 1)->first();
        return view('academico.solicitacao.create', ['semestre' => $semestre, 'orientador' => $orientador, 'academico' => $academico]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolicitacaoRequest $request)
    {
        $solicitacao = Solicitacao::create($request->validated());
        // dd($solicitacao);
        return redirect()->route('home')->with('success', 'Solicitação de orientação enviada com sucesso!');
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
        return redirect()->route('home');
    }

}

