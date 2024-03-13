<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicoEstagioRequest;
use App\Models\AcademicoEstagio;
use App\Models\Academico;
use App\Models\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AcademicoEstagioController extends Controller
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
    public function create(Empresa $empresa)
    {
        $empresa_id = $empresa->id;

        return view('academico.academicoEstagio.create', ['empresa_id' => $empresa_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicoEstagioRequest $request)
    {
        $academico = Academico::where('email', auth()->user()->email)->first();
        $academico_id = $academico->id;

        $academicoEstagio = AcademicoEstagio::create([
            'empresa_id' => $request->input('empresa_id'),
            'academico_id' => $academico_id,
            'tema' => $request->input('tema'),
            'funcao' => $request->input('funcao')]);

        return view('academico.finalacademico', ['academico' => $academico]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicoEstagio $academicoEstagio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicoEstagio $academicoEstagio)
    {
        return view('academico.academicoEstagio.edit', ['academicoEstagio' => $academicoEstagio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcademicoEstagioRequest $request, AcademicoEstagio $academicoEstagio)
    {
        $academicoEstagio->update($request->validated());

        return redirect()->route('academico.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicoEstagio $academicoEstagio)
    {
        //
    }
}
