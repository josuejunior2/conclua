<?php

namespace App\Http\Controllers;

use App\Models\OrientadorGeral;
use App\Models\User;
use App\Models\Area;
use App\Models\Formacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
// use Illuminate\Support\Facades\Auth;

class OrientadorGeralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd("aaa");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formacoes = Formacao::all();
        $areas = Area::all();
        $user = auth()->user();
        return view('complete.orientadorGeral.create', ['user' => $user, 'areas' => $areas, 'formacoes' => $formacoes ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        //dd($request->all());

        $orientadorGeral = OrientadorGeral::create($request->validated());
        $id = $orientadorGeral->id;
        return redirect()->route('orientador.create', ['orientadorgeral_id' => $id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrientadorGeral $orientadorGeral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrientadorGeral $orientadorGeral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrientadorGeral $orientadorGeral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrientadorGeral $orientadorGeral)
    {
        //
    }
}
