<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orientacao;
use PDF;

class OrientacaoAdminController extends Controller
{
    public function index()
    {
        $orientacoes = Orientacao::where('semestre_id', session('semestre_id'))->get();
        return view('admin.orientacao.index', ['orientacoes' => $orientacoes]);
    }
    
    public function exportPdf()
    {
        $orientacoes = Orientacao::where('semestre_id', session('semestre_id'))->with(['Orientador.Admin', 'Academico.User'])->get();
        $arrayOrientacoes = $orientacoes->toArray();
        foreach($orientacoes as $key => $orientacao){
            $arrayOrientacoes[$key]['modalidade'] = $orientacao->modalidade();
            $arrayOrientacoes[$key]['tema'] = $orientacao->tema();
            $arrayOrientacoes[$key]['nota'] = $orientacao->notaTotal();
        }
        $dados = [
            'orientacoes' => $arrayOrientacoes
        ];

        $pdf = PDF::loadView('admin.orientacao.export_pdf', $dados);
        return $pdf->download('document.pdf');
    }
}