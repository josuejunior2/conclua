<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComentarioRequest;
use Illuminate\Support\Facades\Log;

class ComentarioController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ComentarioRequest $request)
    {
        $comentario = Comentario::create($request->validated());
        Log::channel('main')->info('Comentário cadastrado.', ['data' => [$comentario], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->back()->with(['success' => 'Comentário enviado com sucesso.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComentarioRequest $request, Comentario $comentario)
    {
        $comentario->update($request->validated());
        Log::channel('main')->info('Comentário editado.', ['data' => [$comentario], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->back()->with(['success' => 'Comentário atualizado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentario $comentario)
    {
        $comentario->delete();
        Log::channel('main')->info('Comentário excluído.', ['data' => [$comentario], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->back()->with(['success' => 'Comentário excluído com sucesso.']);
    }
}
