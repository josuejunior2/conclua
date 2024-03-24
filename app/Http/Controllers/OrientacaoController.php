<?php

namespace App\Http\Controllers;

use App\Models\Orientacao;
use App\Models\Solicitacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrientacaoRequest;

class OrientacaoController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrientacaoRequest $request)
    {
        // dd($request->all());
        $orientacao = Orientacao::create($request->validated());
        $solicitacao = Solicitacao::where('id', $orientacao->solicitacao_id)->first();
        $solicitacao->status = 1;
        $solicitacao->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Orientacao $orientacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orientacao $orientacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orientacao $orientacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orientacao $orientacao)
    {
        //
    }
}
