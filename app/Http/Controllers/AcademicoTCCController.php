<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicoTCCRequest;
use App\Models\AcademicoTCC;
use App\Models\Academico;
use App\Models\Semestre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcademicoTCCController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if (auth()->guard('web')->check() || auth()->guard('admin')->check()) {
                return $next($request);
            }

            abort(403, 'Não autorizado.');
        });
    }
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
    public function create(Academico $academico, Semestre $semestre)
    {
        return view('academico.academicoTcc.create', ['academico' => $academico, 'semestre' => $semestre]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicoTCCRequest $request)
    {
        $academico = Academico::where('email', auth()->user()->email)->first();
        $academico_id = $academico->id;

        $academicoEstagio = AcademicoTCC::create($request->validated());

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

        return redirect()->route('home')->with('success', 'Cadastro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicoTCC $academicoTCC)
    {
        //
    }
}
