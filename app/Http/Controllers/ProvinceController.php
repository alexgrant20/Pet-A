<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreProvinceRequest;
use App\Http\Requests\Admin\UpdateProvinceRequest;
use App\Models\Province;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends Controller
{
    public function getList()
    {
        $provinces = Province::all();

        return DataTables::of($provinces)
            ->addIndexColumn()
            ->addColumn('action', function ($province) {
                return view('app.admin.master.province.components.__action', compact('province'));
            })
            ->make();
    }

    public function index()
    {
        return view('app.admin.master.province.index');
    }

    public function create()
    {
        return view('app.admin.master.province.create');
    }

    public function store(StoreProvinceRequest $request)
    {
        Province::create($request->validated());

        return to_route('admin.master.province.index')->with('success-toast', 'Province Successfully Created');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Province $province)
    {
        return view('app.admin.master.province.edit', compact('province'));
    }

    public function update(UpdateProvinceRequest $request, Province $province)
    {
        $province->update($request->validated());

        return to_route('admin.master.province.index')->with('success-toast', 'Province Successfully Updated');
    }

    public function destroy(Province $province)
    {
        $province->delete();

        return to_route('admin.master.province.index')->with('success-toast', 'Province Successfully Deleted');
    }
}
