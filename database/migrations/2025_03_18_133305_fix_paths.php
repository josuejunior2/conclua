<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Arquivo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // $arquivos = Arquivo::with([
        //     'Atividade.Orientacao.Semestre',
        //     'Atividade.Orientacao.Academico',
        //     'Atividade.Orientacao.Orientador',
        //     'SubmissaoAtividade.Atividade.Orientacao.Semestre',
        //     'SubmissaoAtividade.Atividade.Orientacao.Orientador',
        //     'Academico',
        // ])->withTrashed()->get();
        // // dd($arquivos);
        // DB::transaction(function() use($arquivos){
        //     foreach($arquivos as $arquivo) {
        //         $extensao = pathinfo($arquivo->nome, PATHINFO_EXTENSION);
        //         $nomeSemExtensao = pathinfo($arquivo->nome, PATHINFO_FILENAME);
        //         $novoNome = Str::slug($nomeSemExtensao) . "-" . $arquivo->created_at->format('YmdHis') . "." . $extensao;

        //         if(!empty($arquivo->Atividade)){
        //             $caminho = 'uploads/01.2025/' . $arquivo->Orientador->diretorio() . '/' . $arquivo->Atividade->Orientacao->Academico->diretorio() . '/' . $arquivo->Atividade->diretorio() . '/auxiliar';
        //             Storage::disk('public')->makeDirectory($caminho);
                    
        //             $novoCaminhoEnome = $caminho . "/" . $novoNome;
                    
        //             Storage::disk('public')->move($arquivo->caminhoEnome(), $novoCaminhoEnome);
        //         } else if(!empty($arquivo->SubmissaoAtividade)){
        //             $caminho = 'uploads/01.2025/' . $arquivo->SubmissaoAtividade->Atividade->Orientacao->Orientador->diretorio() . '/' . $arquivo->Academico->diretorio() . '/' . $arquivo->SubmissaoAtividade->Atividade->diretorio() . '/submissao';
        //             Storage::disk('public')->makeDirectory($caminho);
                    
        //             $novoCaminhoEnome = $caminho . "/" . $novoNome;
                    
        //             Storage::disk('public')->move($arquivo->caminhoEnome(), $novoCaminhoEnome);
        //         } else if(!empty($arquivo->Orientacao)) {
        //             $caminho = 'uploads/01.2025/' . $arquivo->Orientacao->Orientador->diretorio() . '/' . $arquivo->Orientacao->Academico->diretorio() . '/documentacao';
        //             Storage::disk('public')->makeDirectory($caminho);
                    
        //             $novoCaminhoEnome = $caminho . "/" . $novoNome;
                    
        //             Storage::disk('public')->move($arquivo->caminhoEnome(), $novoCaminhoEnome);
        //         } else {
        //             $caminho = 'uploads/01.2025/modelo_documento';
        //             Storage::disk('public')->makeDirectory($caminho);
                    
        //             $novoCaminhoEnome = $caminho . "/" . $novoNome;
                    
        //             Storage::disk('public')->move($arquivo->caminhoEnome(), $novoCaminhoEnome);
        //         }
        //         $arquivo->update([
        //             'caminho' => $caminho,
        //             'nome' => $novoNome
        //         ]);
        //     }
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
