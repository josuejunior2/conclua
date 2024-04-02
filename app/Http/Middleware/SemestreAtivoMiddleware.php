<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\Orientador;
use App\Models\Academico;
use App\Models\AcademicoTCC;
use App\Models\AcademicoEstagio;
use App\Models\Admin;
use Symfony\Component\HttpFoundation\Response;

class SemestreAtivoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // a ideia é verificar se tem semestre ativo && se o semestre ativo têm um acadTCC/Est/Orientacao/etc relativo ao user

        if(Semestre::where('status', 1)->exists()){
            if(auth()->guard('admin')->check()){ // para o admin/orientador
                $orientador = Orientador::where('email', auth()->guard('admin')->user()->email)->first();// mudar essa verificação depois

                if (is_null($orientador) && Admin::where('email', auth()->guard('admin')->user()->email) && auth()->guard('admin')->user()->hasRole('Administrador')) {
                    return $next($request); // se não tiver orientador é que é admin, então pode passar
                } elseif($orientador->status == 0){ // se o cadastro não tá ativado
                    return redirect()->route('welcome')->with('error', 'Seu cadastro no semestre está desativado. Entre em contato com o responsável pelo sistema.');
                } elseif ($orientador->status == 1){
                    return $next($request); // se já está ativado, passa e vai cair no primeiro acesso midd
                }
            } elseif(auth()->guard('web')->check()){ // para o academico
                $academico = Academico::where('email', auth()->guard('web')->user()->email)->first();
                if($academico->status == 0){
                    return redirect()->route('welcome')->with('error', 'Seu cadastro no semestre está desativado. Entre em contato com o responsável pelo sistema.');
                } elseif($academico->status == 1){
                    return $next($request); // se já está ativado, passa e vai cair no primeiro acesso midd
                }
            } else {

                return redirect()->route('welcome');
            }
        }
        // return abort(403, 'Semestre ainda não configurado. Entre em contato com o responsável pelo sistema.');
        return redirect()->route('welcome')->with('error', 'Semestre ainda não configurado. Entre em contato com o responsável pelo sistema.');

    }
}
