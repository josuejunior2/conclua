<?php

namespace App\Http\Controllers;

use App\Models\Formacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FormacaoRequest;

class FormacaoController extends Controller
{
    public function index()
    {
        return view('admin.formacao.index', ['formacoes' => Formacao::all()]);
    }

    public function create()
    {
        return view('admin.formacao.create');
    }

    public function store(FormacaoRequest $request)
    {
        Formacao::create($request->validated());
        return redirect()->route('admin.formacao.index');
    }

    public function edit(Formacao $formacao)
    {
        return view('admin.formacao.edit', ['formacao' => $formacao]);
    }

    public function update(FormacaoRequest $request, Formacao $formacao)
    {
        $formacao->update($request->validated());
        return redirect()->route('admin.formacao.index');
    }

    public function destroy(Formacao $formacao)
    {
        $formacao->delete();
        return redirect()->route('admin.formacao.index');
    }
}
