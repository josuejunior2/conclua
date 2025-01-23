<?php

namespace App\Http\Controllers;

use App\Models\Formacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FormacaoRequest;
use Illuminate\Support\Facades\Log;

class FormacaoController extends Controller
{
    public function index()
    {
        return view('admin.formacao.index', ['formacoes' => Formacao::all()]);
    }

    public function create()
    {
        $this->middleware('permission:criar formacao');
        return view('admin.formacao.create');
    }

    public function store(FormacaoRequest $request)
    {
        $this->middleware('permission:criar formacao');
        $formacao = Formacao::create($request->validated());
        Log::channel('main')->info('Formação cadastrada.', ['data' => [$formacao], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->route('admin.formacao.index');
    }

    public function edit(Formacao $formacao)
    {
        $this->middleware('permission:editar formacao');
        return view('admin.formacao.edit', ['formacao' => $formacao]);
    }

    public function update(FormacaoRequest $request, Formacao $formacao)
    {
        $this->middleware('permission:editar formacao');
        $formacao->update($request->validated());
        Log::channel('main')->info('Formação editada.', ['data' => [$formacao], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->route('admin.formacao.index');
    }

    public function destroy(Formacao $formacao)
    {
        $this->middleware('permission:excluir formacao');
        $formacao->delete();
        Log::channel('main')->info('Formação excluída.', ['data' => [$formacao], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->route('admin.formacao.index');
    }
}
