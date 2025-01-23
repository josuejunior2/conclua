<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AreaRequest;
use Illuminate\Support\Facades\Log;

class AreaController extends Controller
{
    public function index()
    {
        return view('admin.area.index', ['areas' => Area::all()]);
    }

    public function create()
    {
        $this->middleware('permission:criar area');
        return view('admin.area.create');
    }

    public function store(AreaRequest $request)
    {
        $this->middleware('permission:criar area');
        $area = Area::create($request->validated());
        Log::channel('main')->info('Área cadastrada.', ['data' => [$area], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->route('admin.area.index');
    }

    public function edit(Area $area)
    {
        $this->middleware('permission:editar area');
        return view('admin.area.edit', ['area' => $area]);
    }

    public function update(AreaRequest $request, Area $area)
    {
        $this->middleware('permission:editar area');
        $area->update($request->validated());
        Log::channel('main')->info('Área editada.', ['data' => [$area], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->route('admin.area.index');
    }

    public function destroy(Area $area)
    {
        $this->middleware('permission:excluir area');
        $area->delete();
        Log::channel('main')->info('Área excluída.', ['data' => [$area], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->route('admin.area.index');
    }
}
