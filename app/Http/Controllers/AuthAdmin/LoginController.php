<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SemestreOrientador;
use App\Models\Semestre;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;
use Illuminate\Support\Facades\Log;

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

    public function showLoginForm(string $tipo = '')
    {
        return view('admin.auth.login', ['tipo' => $tipo]);
    }

    protected function guard()
    {
        return Auth::guard('admin');
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
            $verificaDataFinal = now() <= $semestreSession->data_fim;

            $validacao = $verificaDataInicio && $verificaDataFinal ? true : false;
            
            $request->session()->put('semestreIsAtivo', $validacao);
        }
        Log::channel('main')->info('Admin logado.', ['user' => $user->nome."[".$user->id."]"]);

    }
    protected function sendFailedLoginResponse(Request $request) {
        throw ValidationException::withMessages([
            'email' => ['Credenciais de acesso inválidas, verifique-as e tente novamente!']
        ]);
    }
}
