<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SemestreRequest;

class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semestres = Semestre::all();
        return view('semestre.index', ['semestres' => $semestres]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('semestre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SemestreRequest $request)
    {
        $semestre = Semestre::create($request->validated());

        return redirect()->route('admin.semestre.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dados = Semestre::find($id);

        return view('semestre.show', ['semestre' => $dados]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semestre $semestre)
    {
        return view('semestre.edit', ['semestre' => $semestre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SemestreRequest $request, Semestre $semestre)
    {
        $semestre->update($request->validated());

        return redirect()->route('admin.semestre.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semestre $semestre)
    {
        $semestre->delete();
        return redirect()->route('admin.semestre.index');
    }
}