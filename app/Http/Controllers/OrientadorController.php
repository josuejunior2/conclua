<?php

namespace App\Http\Controllers;

use App\Models\Orientador;
use App\Models\OrientadorGeral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Requests\OrientadorRequest;

class OrientadorController extends Controller
{
    use HasRoles;
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
    public function create($orientadorGeral_id)
    {
        $orientador = OrientadorGeral::where('email', auth()->guard('admin')->user()->email)->first();
        // dd($orientador);
        if (is_null($orientador)) {
            return redirect()->route('admin.home'); // se não tiver orientador é que é admin, então pode passar
        } elseif(Orientador::where('orientadorGeral_id', $orientador->id)->exists()){
            return redirect()->route('admin.home'); // se já completou o cadastro OU é admin, vai pra home
        } else {
            return view('orientador.orientador.create', ['orientadorGeral_id' => $orientadorGeral_id]); // se não completou o cadastro, vai completar
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrientadorRequest $request)
    {
        $orientador = Orientador::create($request->validated());
        // dd($orientador);
        return view('orientador.finalorientador');
    }

    /**
     * Display the specified resource.
     */
    public function show(Orientador $orientador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orientador $orientador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orientador $orientador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orientador $orientador)
    {
        //
    }
}
