<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SubmissaoAtividadeRequest;
use App\Models\SubmissaoAtividade;
use App\Models\Atividade;

class SubmissaoAtividadeController extends Controller
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
    public function store(SubmissaoAtividadeRequest $request)
    {
        $submissao = SubmissaoAtividade::create($request->validated());
        $atividade = Atividade::find($submissao->atividade_id)->first();
        $atividade->update([
            'data_entrega' => $submissao->created_at
        ]);

        return redirect()->route('atividade.show', ['atividade' => $atividade]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
