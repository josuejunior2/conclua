<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Orientador;
use App\Models\Academico;
use App\Models\AcademicoEstagio;
use App\Models\SemestreOrientador;
use App\Models\Semestre;
use App\Models\AcademicoTCC;

class PrimeiroAcessoMiddleware // Aqui é o primeiroAcesso NO SEMESTRE
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(auth()->guard('admin')->check());
        // if(auth()->guard('admin')->check()){
        //     $orientador = Orientador::where('email', auth()->guard('admin')->user()->email)->first();
        //     // dd($orientador);
        //     if (is_null($orientador)) {
        //         return $next($request); // se não tiver orientador é que é admin, então pode passar
        //     } elseif(is_null(app('semestreAtivo'))){ // acesso sem semestreAtivo
        //         //modificar as permissions
        //         return redirect()->route('welcome')->with('error', 'semestre nao ativado, veja aqui o semestre passado perere parara');
        //     } elseif(app('semestreAtivo')){
        //         if(SemestreOrientador::where('semestre_id', app('semestreAtivo')->id)->where('orientador_id', $orientador->id)->exists()){ // se tá ativado o cadastro...
        //             if(is_null(SemestreOrientador::where('semestre_id', app('semestreAtivo')->id)->where('orientador_id', $orientador->id)->first()->disponibilidade)){ // se não completou, a disp. estará nula
        //                 // dd("midd");
        //                 return redirect()->route('orientador.create'); // se disp. tá nula, não completou o cadastro, vai completar
        //             } else{
        //                 return $next($request); // se disp. tá 0 ou qq coisa == completou o cadastro, entao pode passar
        //             }
        //         }
        //     }
        // } elseif(auth()->guard('web')->check()){
        //     $academico = Academico::where('email', auth()->user()->email)->first();

        //     if ($academico) {
        //         $tcc = AcademicoTCC::where('academico_id', $academico->id)->where('semestre_id', optional(app('semestreAtivo'))->id)->exists();
        //         $estagio = AcademicoEstagio::where('academico_id', $academico->id)->where('semestre_id', optional(app('semestreAtivo'))->id)->exists();

        //         if ($tcc || $estagio) {
        //             return $next($request);
        //         }
        //         else{
            //             return redirect()->route('academico.create');
            //         }
            //     }
            // }
            // dd($orientador->semestreOrientadorAtual);
            // return redirect()->route('welcome')->with('error', 'Seu cadastro no semestre está inativo. Entre em contato com o responsável pelo sistema.');

            // dd(app('semestreAtivo'));
            return $next($request);
    }

}
