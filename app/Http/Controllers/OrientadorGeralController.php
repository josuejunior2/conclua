<?php

namespace App\Http\Controllers;

use App\Models\OrientadorGeral;
use App\Models\Orientador;
use App\Models\User;
use App\Models\Area;
use App\Models\Formacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrientadorGeralRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrientadorGeralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd("index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $formacoes = Formacao::all();
        $areas = Area::all();
        $user = auth()->user();
        return view('orientador.orientadorGeral.create', ['user' => $user, 'areas' => $areas, 'formacoes' => $formacoes ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrientadorGeralRequest $request)
    {
        $orientadorGeral = OrientadorGeral::where('email', auth()->guard('admin')->user()->email)->first();

        if ($orientadorGeral) {
            $orientadorGeral->update($request->validated());

            $orientadorGeral->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->route('orientador.create', ['orientadorgeral_id' => $orientadorGeral->id]);
        }

        return abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrientadorGeral $orientadorgeral)
    {
        $orientador = Orientador::where('orientadorGeral_id', $orientadorgeral->id)->first();
        
        return view('orientador.orientadorGeral.show', ['orientadorGeral' => $orientadorgeral, 'orientador' => $orientador]);
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
