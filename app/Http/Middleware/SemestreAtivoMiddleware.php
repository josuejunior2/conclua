<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\Orientador;
use App\Models\Academico;
use App\Models\AcademicoTCC;
use App\Models\AcademicoEstagio;
use App\Models\SemestreAcademico;
use App\Models\SemestreOrientador;
use App\Models\Admin;
use Carbon\Carbon;
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
        if(session('semestre_id') != Semestre::all()->last()->id){
            Role::where('name', 'Academico')->first()->revokePermissionTo(Permission::where('name', 'TesteAcad')->first());
            Permission::where('name', 'TesteAcad')->first()->removeRole(Role::where('name', 'Academico')->first());

            Role::where('name', 'Orientador')->first()->revokePermissionTo(Permission::where('name', 'TesteOri')->first());
            Permission::where('name', 'TesteOri')->first()->removeRole(Role::where('name', 'Orientador')->first());

            return $next($request);
        } else if(session('semestre_id') == Semestre::all()->last()->id){
            Role::where('name', 'Academico')->first()->givePermissionTo(Permission::where('name', 'TesteAcad')->first());
            Permission::where('name', 'TesteAcad')->first()->assignRole(Role::where('name', 'Academico')->first());

            Role::where('name', 'Orientador')->first()->givePermissionTo(Permission::where('name', 'TesteOri')->first());
            Permission::where('name', 'TesteOri')->first()->assignRole(Role::where('name', 'Orientador')->first());

            return $next($request);
        }
        // if(session('semestre_id')){
        //     if(session('semestre_id') == Semestre::all()->last()->id){
        //         return $next($request);
        //     } else{
        //         Role::where(['name' => 'Academico'])->revokePermissionTo(Permission::create(['name' => 'TesteOri']));
        //         Role::where(['name' => 'Orientador'])->revokePermissionTo(Permission::create(['name' => 'TesteAcad']));
        //         return $next($request);
        //     }
        // }
        return abort(403, 'sem session do semestre');
    }
}

// if(app('semestreAtivo')){
        //     if(Carbon::now() >= app('semestreAtivo')->data_inicio){
        //         if(auth()->guard('admin')->check()){ // para o admin/orientador
        //             $orientador = Orientador::where('email', auth()->guard('admin')->user()->email)->first();// mudar essa verificação depois

        //             if (is_null($orientador) && Admin::where('email', auth()->guard('admin')->user()->email) && auth()->guard('admin')->user()->hasRole('Administrador')) {
        //                 return $next($request); // se não tiver orientador é que é admin, então pode passar
        //             } elseif(SemestreOrientador::where('orientador_id', $orientador->id)->where('semestre_id', optional(app('semestreAtivo'))->id)->exists()){ // se o cadastro tá ativado
        //                 return $next($request); // se já está ativado, passa e vai cair no primeiro acesso midd
        //             } else{ // se não é admin, nem tem cadastro ativado, é orientador com cadastro desativado
        //                 return redirect()->route('welcome')->with('error', 'Seu cadastro no semestre está desativado. Entre em contato com o responsável pelo sistema.');
        //             }
        //         } elseif(auth()->guard('web')->check()){ // para o academico
        //             $academico = Academico::where('email', auth()->guard('web')->user()->email)->first();
        //             if(SemestreAcademico::where('academico_id', $academico->id)->where('semestre_id', optional(app('semestreAtivo'))->id)->exists()){
        //                 return $next($request); // se já está ativado, passa e vai cair no primeiro acesso midd
        //             } else{
        //                 return redirect()->route('welcome')->with('error', 'Seu cadastro no semestre está inativo. Entre em contato com o responsável pelo sistema.');
        //             }
        //         } else {
        //             return redirect()->route('welcome');
        //         }
        //     } else{
        //         return redirect()->route('welcome')->with('error', 'O semestre ainda não iniciou. Data de início do semestre: '.Carbon::parse(app('semestreAtivo')->data_inicio)->format('d/m/y'));
        //     }
        // }
        // return redirect()->route('welcome')->with('error', 'Semestre ainda não configurado ou desativado. Entre em contato com o responsável pelo sistema.');
