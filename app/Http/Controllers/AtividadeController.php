<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\AtividadeRequest;
use App\Http\Requests\AvaliarAtividadeRequest;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $atividades = Atividade::where('orientacao.semestre_id', session('semestre_id'))->get();
        $atividades = Atividade::all();
        return view('atividade.index', ['atividades' => $atividades]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->middleware('permission:criar atividade');
        $orientacoes = auth()->guard('admin')->user()->Orientador->orientacoes->where('semestre_id', session('semestre_id'));

        return view('atividade.create', ['orientacoes' => $orientacoes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AtividadeRequest $request)
    {
        // $dados = Atividade::create($request->validated());

        $dados = $request->validated();
        $arquivos = $dados['arquivos_aux'];
        $usuario = auth()->guard('admin')->user();
        $atividade = Atividade::create($dados);

        if ($request->hasFile('arquivos_aux')) {
            $caminho = 'uploads/'.$atividade->Orientacao->Semestre->periodoAno() . '/' . $atividade->Orientacao->Orientador->diretorio() . '/' . $atividade->Orientacao->Academico->diretorio() . '/enviado';
            foreach ($arquivos as $key => $arquivo) {
                $usuario->arquivos()->create([
                    'nome' => $arquivo->getClientOriginalName(),
                    'atividade_id' => $atividade->id,
                    'caminho' => $caminho,
                ]);
                $arquivo->move($caminho, $arquivo->getClientOriginalName());
            }
        }
        return redirect()->route('atividade.show', ['atividade' => $atividade]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Atividade $atividade)
    {
        return view('atividade.show', ['atividade' => $atividade]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atividade $atividade)
    {
        $this->middleware('permission:editar atividade');
        $orientacoes = auth()->guard('admin')->user()->Orientador->orientacoes->where('semestre_id', session('semestre_id'));

        return view('atividade.edit', ['atividade' => $atividade, 'orientacoes' => $orientacoes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtividadeRequest $request, Atividade $atividade)
    {
        $this->middleware('permission:editar atividade');
        $atividade->update($request->validated());
        return redirect()->route('atividade.show', ['atividade' => $atividade]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atividade $atividade)
    {
        if($atividade->SubmissaoAtividade) $atividade->SubmissaoAtividade->forceDelete();
        $atividade->forceDelete();
        return redirect()->route('atividade.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function avaliar(AvaliarAtividadeRequest $request, Atividade $atividade)
    {
        $atividade->update($request->validated());
        return redirect()->route('atividade.show', ['atividade' => $atividade]);
    }

}
