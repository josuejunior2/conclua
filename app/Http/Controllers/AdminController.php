<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.admin.index', ['admins' => Admin::role('Admin')->get()]);
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
            $admin->assignRole($request->validated()['perfil']);
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
        $this->middleware('permission:editar academico');

        DB::transaction(function() use($request, $admin){   
            $dados = $request->validated();
            $admin->update($dados);
            $admin->assignRole($request->validated()['perfil']);
        });

        return redirect()->route('admin.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $this->middleware('permission:excluir academico');

        DB::transaction(function() use($admin){   
            $admin->delete();
        });

        return redirect()->route('admin.admin.index');
    }

}
