<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\OrientadoresGeralImport;
use App\Imports\AcademicosImport;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
    /**
     * Cadastra os dados basicos de orientadores por tabela excel.
     */
    public function import_orientadores()
    {
        Excel::import(new UsersImport, 'orientadores.xlsx');
        Excel::import(new OrientadoresGeralImport, 'orientadores.xlsx');

        // aí aqui tem que dar assignrole
        return dd('deu certo');
    }
    /**
     * Cadastra os dados basicos de academicos por tabela excel.
     */
    public function import_academicos()
    {
        Excel::import(new UsersImport, 'academicos.xlsx');
        Excel::import(new AcademicosImport, 'academicos.xlsx');
        // aí aqui tem que dar assignrole

        return dd('deu certo');
    }

}
