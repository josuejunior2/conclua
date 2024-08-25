<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Semestre;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    protected function loggedOut(Request $request)
    {
        return redirect()->route('login');
    }

    public function authenticated(Request $request, $user)
    { // aqui eu quero colocar a session do semestreAtivo, mas se não tiver, colocar a session do último semestre que o acad/orientador participou
        $ultimoSemestre = Semestre::all()->last();
        if($ultimoSemestre){ $request->session()->put('semestre_id', $ultimoSemestre->id); }

        $semestreSession = Semestre::find(session('semestre_id'));
        $verificaSemestre = $ultimoSemestre == $semestreSession;
        $verificaDataInicio = now() >= $semestreSession->data_inicio;
        $verificaDataFinal = now() < $semestreSession->data_fim;

        if($verificaSemestre && $verificaDataInicio && $verificaDataFinal){
            $validacao = true;
        } else if(!$verificaSemestre && $verificaDataInicio && $verificaDataFinal){
            $validacao = true;
        } else {
            $validacao = false;
        }
        
        $request->session()->put('semestreIsAtivo', $validacao);
    }
}
