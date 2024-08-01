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
use Illuminate\Support\Facades\Storage;

class AtividadeOrientadorController extends Controller
{
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
                Arquivo::create([
                    'nome' => $arquivo->getClientOriginalName(),
                    'atividade_id' => $atividade->id,
                    'orientador_id' => $atividade->Orientacao->Orientador->id,
                    'caminho' => $caminho,
                ]);
                $arquivo->move($caminho, $arquivo->getClientOriginalName());
            }
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
            $caminho = 'uploads/'.$atividade->Orientacao->Semestre->periodoAno() . '/' . $atividade->Orientacao->Orientador->diretorio() . '/' . $atividade->Orientacao->Academico->diretorio() . '/enviado';
            foreach ($arquivos as $key => $arquivo) {
                Arquivo::create([
                    'nome' => $arquivo->getClientOriginalName(),
                    'atividade_id' => $atividade->id,
                    'orientador_id' => $atividade->Orientacao->Orientador->id,
                    'caminho' => $caminho,
                ]);
                $arquivo->move($caminho, $arquivo->getClientOriginalName());
            }
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
    
    /**
     * Store a newly created resource in storage.
     */
    public function storeArquivoAux(ArquivoAuxRequest $request, Atividade $atividade)
    {
        // $dados = Atividade::create($request->validated());

        $dados = $request->validated();
        $arquivos = $dados['arquivos_aux'];

        if ($request->hasFile('arquivos_aux')) {
            $caminho = 'uploads/'.$atividade->Orientacao->Semestre->periodoAno() . '/' . $atividade->Orientacao->Orientador->diretorio() . '/' . $atividade->Orientacao->Academico->diretorio() . '/enviado';
            foreach ($arquivos as $key => $arquivo) {
                Arquivo::create([
                    'nome' => $arquivo->getClientOriginalName(),
                    'atividade_id' => $atividade->id,
                    'orientador_id' => $atividade->Orientacao->Orientador->id,
                    'caminho' => $caminho,
                ]);
                $arquivo->move($caminho, $arquivo->getClientOriginalName());
            }
        }
        return redirect()->back()->with(['success' => 'Arquivo auxiliar adicionado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyArquivoAux(Arquivo $arquivo)
    {
        unlink('./'.$arquivo->caminho.'/'.$arquivo->nome);
        $arquivo->forceDelete();
        return redirect()->back()->with(['success' => 'Arquivo auxiliar excluído com sucesso.']);
    }

}
