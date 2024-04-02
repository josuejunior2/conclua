<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use App\Models\Academico;
use App\Models\Orientador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SemestreRequest;

class SemestreController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if (auth()->guard('admin')->check()) {
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
        $semestres = Semestre::all();
        return view('admin.semestre.index', ['semestres' => $semestres]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.semestre.create');
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

        return view('admin.semestre.show', ['semestre' => $dados]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semestre $semestre)
    {
        return view('admin.semestre.edit', ['semestre' => $semestre]);
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

    /**
     * Ativa o semestre
     */
    public function ativar(string $id)
    {
        $semestre = Semestre::find($id);

        if(Semestre::where('status', 1)->exists()){
            return abort(403, 'Desative o semestre em ativo');
        } else{
            $semestre->update(['status' => 1]);
        }

        return redirect()->route('admin.semestre.index');
    }

    /**
     * Desativa o semestre e o cadastro de academicos e orientadores
     */
    public function desativar(string $id)
    {
        $semestre = Semestre::find($id);
        foreach(Academico::all() as $academico){
            $academico->status = 0;
        }
        foreach(Orientador::all() as $orientador){
            $orientador->status = 0;
        }

        $semestre->update(['status' => 0]);

        return redirect()->route('admin.semestre.index');
    }
}

