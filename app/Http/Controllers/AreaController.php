<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AreaRequest;

class AreaController extends Controller
{
    public function index()
    {
        return view('admin.area.index', ['areas' => Area::all()]);
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function store(AreaRequest $request)
    {
        Area::create($request->validated());
        return redirect()->route('admin.area.index');
    }

    public function edit(Area $area)
    {
        return view('admin.area.edit', ['area' => $area]);
    }

    public function update(AreaRequest $request, Area $area)
    {
        $area->update($request->validated());
        return redirect()->route('admin.area.index');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('admin.area.index');
    }
}
