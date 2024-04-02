<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Academico;
use App\Models\Semestre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;

class EmpresaController extends Controller
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
        return view('empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaRequest $request)
    {
        $empresa = Empresa::create($request->validated());
        $academico = Academico::where('email', auth()->user()->email)->first();
        // dd($academico);
        $semestre = Semestre::where('status', 1)->first();

        return redirect()->route('academicoEstagio.create', ['empresa' => $empresa, 'academico' => $academico, 'semestre' => $semestre]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        // dd($empresa);
        return view('empresa.edit', ['empresa' => $empresa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpresaRequest $request, Empresa $empresa)
    {
        $empresa->update($request->validated());
        return redirect()->route('home'); // o redirecionamento aqui ta paia, n sei se ta mudando na solicitacao, ou se vai ser em outro lugar...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
