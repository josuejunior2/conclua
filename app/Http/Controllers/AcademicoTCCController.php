<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicoTCCRequest;
use App\Models\AcademicoTCC;
use App\Models\Academico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcademicoTCCController extends Controller
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
        return view('academico.academicoTcc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicoTCCRequest $request)
    {
        $academico = Academico::where('email', auth()->user()->email)->first();
        $academico_id = $academico->id;

        $academicoEstagio = AcademicoTCC::create([
            'academico_id' => $academico_id,
            'tema' => $request->input('tema'),
            'resumo' => $request->input('resumo')]);

        return view('academico.finalacademico');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicoTCC $academicoTCC)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicoTCC $academicoTCC)
    {
        //
    }
}
