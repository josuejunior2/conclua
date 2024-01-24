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
        return view('orientador.orientador.create', ['orientadorGeral_id' => $orientadorGeral_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrientadorRequest $request)
    {

        $orientador = Orientador::create($request->validated());
        
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
