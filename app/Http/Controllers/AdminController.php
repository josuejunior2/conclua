<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:visualizar admin')->only(['index', 'show']);
        $this->middleware('permission:criar admin')->only(['create', 'store']); 
        $this->middleware('permission:editar admin')->only(['edit', 'update']); 
        $this->middleware('permission:excluir admin')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.admin.index', ['admins' => Admin::withoutRole('Orientador')->withTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->middleware('permission:criar admin');
        return view('admin.admin.create', ['roles' => Role::where('guard_name', 'admin')->whereNot('name', 'Orientador')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        $this->middleware('permission:criar admin');

        DB::transaction(function() use($request){   
            $admin = Admin::create($request->validated());
            $admin->syncRoles($request->validated()['perfil']);
            Log::channel('main')->info('Admin cadastrado.', ['data' => [$admin, $request->validated()['perfil']], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });

        return redirect()->route('admin.admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('admin.admin.show', ['admin' => $admin]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $this->middleware('permission:editar academico');
        return view('admin.admin.edit', ['admin' => $admin, 'roles' => Role::where('guard_name', 'admin')->whereNot('name', 'Orientador')->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        DB::transaction(function() use($request, $admin){   
            $dados = $request->validated();
            $admin->update(
                [
                'nome'     => $dados['nome'],
                'email'    => $dados['email'],
                'password'    => $dados['password'] ?? $admin->password,
                ]
            );
            $admin->syncRoles($dados['perfil']);
            Log::channel('main')->info('Admin editado.', ['data' => [$admin, $dados['perfil']], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });

        return redirect()->route('admin.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::withTrashed()->findOrFail($id);
        DB::transaction(function() use($admin){
            if($admin->trashed()) {
                $admin->restore();
                Log::channel('main')->info('Admin desbloqueado.', ['data' => [$admin], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
            }
            else {
                $admin->delete();
                Log::channel('main')->info('Admin bloqueado.', ['data' => [$admin], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
            }
        });

        return redirect()->route('admin.admin.index');
    }

}
