<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicoEstagioRequest;
use App\Models\AcademicoEstagio;
use App\Models\Academico;
use App\Models\Empresa;
use App\Models\Semestre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class AcademicoEstagioController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Empresa $empresa, Academico $academico, Semestre $semestre)
    {
        return view('academico.academicoEstagio.create', ['empresa' => $empresa, 'academico' => $academico, 'semestre' => $semestre]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicoEstagioRequest $request)
    {
        $academico = Academico::where('user_id', auth()->user()->id)->first();
        // dd($request->all());
        $academicoEstagio = AcademicoEstagio::create($request->validated());
        Log::channel('main')->info('Estágio cadastrado.', ['data' => [$academicoEstagio], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);

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
        Log::channel('main')->info('Estágio atualizado.', ['data' => [$academicoEstagio], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);

        return redirect()->route('home');
    }
}
