<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicoTCCRequest;
use App\Models\AcademicoTCC;
use App\Models\Academico;
use App\Models\Semestre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AcademicoTCCController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Academico $academico, Semestre $semestre)
    {
        return view('academico.academicoTcc.create', ['academico' => $academico, 'semestre' => $semestre]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicoTCCRequest $request)
    {
        $tcc = AcademicoTCC::create($request->validated());
        $academico = Academico::where('user_id', auth()->user()->id)->first();
        Log::channel('main')->info('TCC cadastrado.', ['data' => [$tcc], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);

        return view('academico.finalacademico', ['academico' => $academico]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicoTCC $academicoTCC)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicoTCC $academicoTCC)
    {
        return view('academico.academicoTcc.edit', ['academicoTCC' => $academicoTCC]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcademicoTCCRequest $request, AcademicoTCC $academicoTCC)
    {
        $academicoTCC->update($request->validated());
        Log::channel('main')->info('TCC atualizado.', ['data' => [$academicoTCC], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);

        return redirect()->route('home')->with('success', 'Cadastro atualizado com sucesso!');
    }
}
