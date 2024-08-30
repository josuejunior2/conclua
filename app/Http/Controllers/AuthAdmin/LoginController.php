<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SemestreOrientador;
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
    protected $redirectTo = RouteServiceProvider::HOMEADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout'); // comentei pq talvez tem bo, ver dps
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }

    public function authenticated(Request $request, $user)
    {
        $ultimoSemestre = Semestre::all()->last();
        if($ultimoSemestre){ 
            $request->session()->put('semestre_id', $ultimoSemestre->id); 
            
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
}
