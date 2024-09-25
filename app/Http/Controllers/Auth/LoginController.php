<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Semestre;
use Illuminate\Validation\ValidationException;

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
        return redirect()->route('welcome');
    }

    public function authenticated(Request $request, $user)
    { 
        $semestreAtual = Semestre::where('data_inicio', '<', now())->where('data_fim', '>=', now())->first() ?? Semestre::all()->first();
        if($semestreAtual){ 
            $request->session()->put('semestre_id', $semestreAtual->id); 
            
            $semestreSession = Semestre::find(session('semestre_id'));

            $verificaDataInicio = now() >= $semestreSession->data_inicio;
            $verificaDataFinal = now() < $semestreSession->data_fim;

            $validacao = $verificaDataInicio && $verificaDataFinal ? true : false;
            
            $request->session()->put('semestreIsAtivo', $validacao);
        }

    }
    
    protected function sendFailedLoginResponse(Request $request) {
        throw ValidationException::withMessages([
            'email' => ['Credenciais de acesso inválidas, verifique-as e tente novamente!']
        ]);
    }
}
