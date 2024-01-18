<?php

namespace App\Http\Controllers;

use App\Models\Orientador;
use App\Models\OrientadorGeral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

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
        return view('complete.orientador.create', ['orientadorGeral_id' => $orientadorGeral_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $regras = [
            'enderecoLattes' => 'required|min:38|max:38',
            'enderecoOrcid' => 'required|min:37|max:37',
            'disponibilidade' => 'required'
        ];
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'enderecoLattes.min' => 'O link deve ter 38 caracteres.',
            'enderecoLattes.max' => 'O link deve ter 38 caracteres.',
            'enderecoOrcid.min' => 'O link deve ter 37 caracteres.',
            'enderecoOrcid.max' => 'O link deve ter 37 caracteres.',
        ];
        $request->validate($regras, $feedback);
        $orientador = Orientador::create($request->all());
        $user = User::find(auth()->user()->id);
        $user->assignRole('orientador');
        dd($user);
        return view('complete.finalorientador');
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
