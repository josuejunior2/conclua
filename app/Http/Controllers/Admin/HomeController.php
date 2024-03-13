<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = auth()->guard('admin')->user();
        if($admin->hasRole('Admin')){
            return view('admin.home');
        } elseif($admin->hasRole('Orientador')){
            return redirect()->route('orientadorgeral.index');
        } else{
            return abort(403, 'Você não está autenticado ao sistema.');
        }
    }
}
