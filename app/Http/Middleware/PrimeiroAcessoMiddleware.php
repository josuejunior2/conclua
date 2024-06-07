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

        $semestreEmSession = Semestre::find(session('semestre_id'));
        // dd(auth()->guard('admin')->check());
        if(auth()->guard('admin')->check()){
            $orientador = Orientador::where('admin_id', auth()->guard('admin')->user()->id)->first();
            if (is_null($orientador)) {
                return $next($request); // se não tiver orientador é que é admin, então pode passar
            } elseif(!is_null($orientador->disponibilidade)){ // se tá ativado o cadastro...
                return $next($request); // se disp. tá 0 ou qq coisa == completou o cadastro, entao pode passar
            } else{
                // dd("oi");
                return redirect()->route('orientador.create'); // se disp. tá nula, não completou o cadastro, vai completar
            }
        } elseif(auth()->guard('web')->check()){
            $academico = Academico::where('user_id', auth()->user()->id)->first();

            if ($academico) {
                $tcc = AcademicoTCC::where('academico_id', $academico->id)->where('semestre_id', session('semestre_id'))->exists();
                $estagio = AcademicoEstagio::where('academico_id', $academico->id)->where('semestre_id', session('semestre_id'))->exists();

                if ($tcc || $estagio) {
                    return $next($request);
                }
                else{
                        return redirect()->route('academico.create');
                    }
                }
            }
            return redirect()->route('welcome')->with('error', 'Seu cadastro no semestre está inativo. Entre em contato com o responsável pelo sistema.');

    }

}
