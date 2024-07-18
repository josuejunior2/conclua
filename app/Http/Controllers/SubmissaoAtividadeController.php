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
        $dados = $request->validated();
        $arquivos = $dados['arquivos_submissao'];
        $usuario = auth()->guard('web')->user();
        $submissao = SubmissaoAtividade::create($request->validated());
        $submissao->Atividade->update([
            'data_entrega' => $submissao->created_at
        ]);

        if ($request->hasFile('arquivos_submissao')) {
            $caminho = 'uploads/'.$submissao->Atividade->Orientacao->Semestre->periodoAno() . '/' . $submissao->Atividade->Orientacao->Orientador->diretorio() . '/' . $submissao->Atividade->Orientacao->Academico->diretorio();
            foreach ($arquivos as $key => $arquivo) {
                $usuario->arquivos()->create([
                    'nome' => $arquivo->getClientOriginalName(),
                    'atividade_id' => $submissao->Atividade->id,
                    'caminho' => $caminho,
                ]);
                $arquivo->move($caminho, $arquivo->getClientOriginalName());
            }
        }

        return redirect()->route('atividade.show', ['atividade' => $submissao->Atividade]);
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
