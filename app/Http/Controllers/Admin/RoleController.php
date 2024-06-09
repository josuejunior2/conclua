<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->validated());

        return redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.role.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.role.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return redirect()->route('admin.role.show', ['role' => $role]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.role.index');
    }
}
