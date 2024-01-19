<?php

namespace App\Http\Controllers;

use App\Models\Academico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcademicoController extends Controller
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

        $user = auth()->user();
        return view('academico.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $academico = Academico::firstOrCreate($request->validated());

        if($request->input('modalidade') == 0){
            return redirect()->route('academicoEstagio.create', ['academico' => $academico]);
        }
        elseif($request->input('modalidade') == 1){
            return redirect()->route('academicoMonografia.create', ['academico' => $academico]);
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Academico $academico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academico $academico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academico $academico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academico $academico)
    {
        //
    }
}
